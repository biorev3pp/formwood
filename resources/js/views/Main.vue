<template>
    <div>
        <div id="app">
            <div>
                <header>
                    <div class="logo">
                        <div id="nav-icon" :class="[(sidemenu)?'open':'']" @click="sidemenu = !sidemenu">
                            <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
                        </div>
                        <a :href="(settings.application_logo_link)?settings.application_logo_link:'javascript:;'" :target="(settings.application_logo_link)?'_blank':''" class="router-link-active">
                            <img :src="(settings.application_logo)?$media+settings.application_logo:$media+logopath" :alt="settings.app_title?settings.app_title:'FormWood'" /> 
                        </a>
                    </div>
                    <div class="fw_container">
                        <ul class="progressbar">
                            <li v-for="n in 8" class="" :key="'step'+n" :class="[(active_step == n)?'active':(active_step > n && (cart.skipped === 0 || cart.skipped >= n))?'completed':'', (clickable == n)?'clickable':'', (skipped == n)?'skipped1':'', (n == 6 && cart.current_item.sheet_type_id > 1)?'skipped':'']">
                                <span :title="'Step '+n" class="steps" v-if="n == 6 && cart.current_item.sheet_type_id > 1">
                                    {{n}}
                                </span>
                                <span :title="'Step '+n" class="steps" v-else-if="(active_step > n && (cart.skipped === 0 || cart.skipped >= n))" @click="goBack(n)" >
                                    {{n}}
                                </span>
                                <span :title="'Step '+n" class="steps" v-else-if="clickable == n" @click="goNext(n)">
                                    {{n}}
                                </span>                                
                                <span :title="'Step '+n" class="steps" v-else>{{n}}</span>
                                <StepTitle :step="n" :data="settings"></StepTitle>
                            </li>
                        </ul>
                    </div>
                </header>
            </div>

            <div>
                <div class="main-wrapper">
                    <div class="section-center">
                        <div id="mainCntWrap" class="mx-auto" v-if="loader">
                            <div class="spinner"></div>
                        </div>
                        <div id="mainCntWrap" class="mx-auto" v-else>
                            <Transition name="slide-fade">
                                <Species :cart="cart" v-if="active_step == 1" v-on:updatespecies="setCartItem" />
                                <Slicing :cart="cart" v-else-if="active_step == 2" v-on:updatecuts="setCartItem" />
                                <Quality :cart="cart" v-else-if="active_step == 3" v-on:updatequality="setCartItem" />
                                <Matching :cart="cart" v-else-if="active_step == 4" v-on:updatematching="setCartItem" />
                                <ProductCat :cart="cart" v-else-if="active_step == 5" v-on:updatesize="setSizeInItem" />
                                <CoreOptions :cart="cart" v-else-if="active_step == 6" v-on:updateoption="setPanelOption" />
                                <Backer :cart="cart" v-else-if="active_step == 7"  v-on:updatebaker="setCartItem"  />
                                <Download :tlink="settings.privacy_policy_link" :mfields="settings.mandatory_fields" :cart="cart" v-else-if="active_step == 8"  v-on:updatecustomer="setCustomer" v-on:resetpage="resetpage" v-on:anotherproduct="setAnotherProduct"  />
                            </Transition>
                        </div>
                    </div>
                    <span>
                        <div class="sidemenu " :class="[(sidemenu)?'sidebar-show':'']" style="z-index: 1000;">
                            <div id="sideMenuTab" class="sidemenu-content">
                                <div class="header-bg">
                                    <div class="header">
                                        <h2>{{settings.app_title}}</h2>
                                    </div>
                                    <SideContent :step="active_step" :data="settings" />
                                </div>
                            </div>
                            <div class="get-in-contact">
                                <a :href="'tel:'+calling_no" v-if="settings.contact_no">{{settings.contact_no}}</a>
                            </div>
                            <div class="get-in-touch">
                                <a :href="settings.get_in_touch_link" target="_blank" v-if="settings.get_in_touch_link">Get In Touch</a>
                            </div>
                        </div>

                        <div class="footer" :class="[(active_step >= 3 && active_step <= 7)?'mob-footer':'']">
                            <div class="row h-100 align-items-center">
                                <div class="skp-btn-div" v-if="skipBtnStatus">
                                    <button type="button" @click="startOver" class="stovr-btn">Start Over</button>
                                    <button type="button" @click="goNext(8)" class="skp-btn">Skip to download</button>
                                </div>
                                <div class="nav-btn-div">
                                    <div class="footer-btns pbtns" :class="[(bottommenu)?'':'hide-footer-btns']" v-if="prevBtnStatus">
                                        <button type="button" @click="goBack()" class="pbs-btn">Previous</button>
                                    </div>
                                    <div class="footer-btns fns-btn" :class="[(bottommenu)?'':'hide-footer-btns']" v-if="nextBtnStatus">
                                        <button type="button" @click="goNext()" v-if="active_step <= 7" class="">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.slide-fade-enter-active {
    transition: all 1500ms ease;
  }
  .slide-fade-leave-active {
    transition: all 500ms ease;
  }
  .slide-fade-enter
  /* .slide-fade-leave-active below version 2.1.8 */ {
    transform: translateX(1000px);
    opacity: 0;
  }
   .slide-fade-leave-to
  /* .slide-fade-leave-active below version 2.1.8 */ {
    transform: translateX(-500px);
    opacity: 0;
  }
</style>
<script>
    import Slicing from "./includes/Slicing.vue";
    import Species from "./includes/Species.vue";
    import Quality from "./includes/Quality.vue";
    import Matching from "./includes/Matching.vue";
    import ProductCat from "./includes/Product-cat.vue";
    import CoreOptions from "./includes/Core-options.vue";
    import Backer from "./includes/Backer.vue";
    import Download from "./includes/Download.vue";
    import StepTitle from './elements/StepTitle.vue';
    import SideContent from './elements/SideContent.vue';

    export default {
        components: { Species, Slicing, Quality, Matching, ProductCat, CoreOptions, Backer, Download, StepTitle, SideContent },
        data() {
            return {
                loader:false,
                logopath: 'FormwoodLogo.png',
                active_step: 1,
                sidemenu:false,
                bottommenu:true,
                nextBtnStatus: true,
                prevBtnStatus: false,
                skipBtnStatus: false,
                settings:{},
                cart:{
                    customer:{},
                    current_item:{
                        species_id:'',
                        cut_id:'',
                        quality_id:'',
                        matching_id:'',
                        sheet_type_id:'',
                        size_id:'',
                        panel_substrate_id:'',
                        panel_thickness_id:'',
                        backer_id:'',
                        quantity:1,
                        custom_width:'',
                        custom_length:''
                    },
                    items:[],
                    skipped:0
                }
            };
        },
        computed:{
            calling_no() {
                return '+'+this.settings.contact_no.replace(/[^0-9]/g, '')
            },
            clickable() {
                if(this.active_step == 1 && this.cart.current_item.species_id >= 1) {
                    return 2;
                }
                else if(this.active_step == 2 && this.cart.current_item.cut_id >= 1) {
                    return 3;
                }
                else if(this.active_step == 3 && this.cart.current_item.quality_id >= 1) {
                    return 4;
                }
                else if(this.active_step == 4 && this.cart.current_item.matching_id >= 1 && (this.cart.skipped == 0 || this.cart.skipped > 4)) {
                    return 5;
                }
                else if(this.active_step == 5 && (this.cart.skipped == 0 || this.cart.skipped > 5)) {
                    if(this.cart.current_item.sheet_type_id == 1 && this.cart.current_item.size_id !== '') {
                        return 6;
                    }
                    else if(this.cart.current_item.sheet_type_id > 1 && this.cart.current_item.size_id !== '') {
                        return 7;
                    }
                }
                else if(this.active_step == 6 && this.cart.current_item.panel_substrate_id >= 1 && this.cart.current_item.panel_thickness_id >= 1 && (this.cart.skipped == 0 || this.cart.skipped > 6)) {
                    return 7;
                } else if(this.active_step == 7 && this.cart.current_item.backer_id >= 1 && (this.cart.skipped == 0 || this.cart.skipped > 7)) {
                    return 8;
                } else {
                    return 0;
                }
            },
            skipped() {
                if(this.active_step >= 5 && this.cart.current_item.sheet_type_id > 1) {
                    return 6;
                } else {
                    return 0;
                }
            }
        },
        watch: {
            active_step(nvalue, ovalue) {
                if(nvalue >= this.settings.skippable_step_no && nvalue <= 7) {
                    this.skipBtnStatus = true
                } else {
                    this.skipBtnStatus = false
                }
                if(nvalue == 8) {
                    this.nextBtnStatus = false
                } else {
                    this.nextBtnStatus = true
                }
                if(nvalue >= 2) {
                    this.prevBtnStatus = true
                } else {
                    this.prevBtnStatus = false
                }
            }
        },
        methods: {
            goNext(val) {
                if(val == 8) {
                    this.cart.skipped = this.active_step
                } else {
                    this.cart.skipped = 0
                }
                if (this.active_step <= 7) {
                    if (val) {
                        this.active_step = val;
                    } else if(this.goodToGo()) {
                        if(this.active_step == 5 && this.cart.current_item.sheet_type_id >= 2) {
                            this.active_step = this.active_step + 2;    
                        } else {
                            this.active_step++;
                        }
                    } 
                }
            },
            goBack(val) {
                if(val) {
                    this.active_step = val;
                    return true
                }
                if(this.active_step == 8 && this.cart.skipped >= 2) {
                    this.active_step = this.cart.skipped;
                    this.cart.skipped = 0;
                    return true
                }
                if (this.active_step > 1) {
                    if(this.active_step == 7 && this.cart.current_item.sheet_type_id >= 2) {
                        this.active_step = this.active_step - 2;    
                    } else {
                        this.active_step--;
                    }
                    
                }
            },
            goodToGo() {
                if(this.active_step == 1 &&  this.cart.current_item.species_id == '') {
                    this.$toast.error('Please select one of the species');
                    return false
                } else if(this.active_step == 2 &&  this.cart.current_item.cut_id == '') {
                    this.$toast.error('Please select one of the slicing technique');
                    return false
                } else if(this.active_step == 3 &&  this.cart.current_item.quality_id == '') {
                    // Do not required
                    return true
                } else if(this.active_step == 4 &&  this.cart.current_item.matching_id == '') {
                    /* this.$toast.error('Please select the matching option');
                    return false */
                    return true
                    // Do not required
                } else if(this.active_step == 5) {
                    if(this.cart.current_item.sheet_type_id == '') {
                        this.$toast.error('Please select the product category');
                        return false
                    } else if(this.cart.current_item.size_id === '') {
                        this.$toast.error('Please select relevant size. You can also add custom size.');
                        return false
                    } else if(this.cart.current_item.size_id === 0 && (this.cart.current_item.custom_length == '' || this.cart.current_item.custom_width == '')) {
                        this.$toast.error('You have selected custom size. Please enter desire width x length.');
                        return false
                    } else if(Number(this.cart.current_item.quantity) == 0) {
                        this.$toast.error('Please enter the quantity you need.');
                        return false
                    }  else {
                        return true
                    }
                } else if(this.active_step == 6 && (this.cart.current_item.panel_thickness_id == '' || this.cart.current_item.panel_substrate_id == '')) { 
                    // DO not required
                    /* this.$toast.error('Please select panel substrate and core thickness.');
                    return false */
                    return true
                } else {
                    return true
                }
            },
            setSizeInItem(...data) {
                this.cart.current_item['sheet_type_id'] = data[0]
                this.cart.current_item['size_id'] = data[1]
                this.cart.current_item['custom_width'] = data[2]
                this.cart.current_item['custom_length'] = data[3]
                this.cart.current_item['quantity'] = data[4]
                this.cart.current_item.backer_id = '';
                this.cart.current_item['panel_substrate_id'] = ''
                this.cart.current_item['panel_thickness_id'] = ''
                localStorage.setItem('cart', JSON.stringify(this.cart))
            },
            setPanelOption(...data) {
                this.cart.current_item['panel_substrate_id'] = data[0]
                this.cart.current_item['panel_thickness_id'] = data[1]
                localStorage.setItem('cart', JSON.stringify(this.cart))
            },
            setCartItem(field, sid) {
                if(field == 'species_id') {
                    this.cart.current_item.cut_id = '';
                    this.cart.current_item.quality_id = '';
                    this.cart.current_item.matching_id = '';
                }
                if(field == 'cut_id') {
                    this.cart.current_item.matching_id = '';
                }
                this.cart.current_item[field] = sid;
                localStorage.setItem('cart', JSON.stringify(this.cart))
            },
            setCustomer(val) {
                this.cart.customer = val
                localStorage.setItem('cart', JSON.stringify(this.cart))
            },
            startOver() {
                this.cart.current_item = {
                    species_id:'',
                    cut_id:'',
                    quality_id:'',
                    matching_id:'',
                    sheet_type_id:'',
                    size_id:'',
                    panel_substrate_id:'',
                    panel_thickness_id:'',
                    backer_id:'',
                    quantity:1,
                    custom_width:'',
                    custom_length:''
                }
                this.cart.skipped = 0;
                this.active_step = 1;
                localStorage.setItem('cart', JSON.stringify(this.cart))
            },
            setAnotherProduct() {
                this.cart.items.push(this.cart.current_item);
                this.cart.current_item = {
                        species_id:'',
                        cut_id:'',
                        quality_id:'',
                        matching_id:'',
                        sheet_type_id:'',
                        size_id:'',
                        panel_substrate_id:'',
                        panel_thickness_id:'',
                        backer_id:'',
                        quantity:1,
                        custom_width:'',
                        custom_length:''
                    }
                this.cart.skipped = 0;
                this.active_step = 1;
                localStorage.setItem('cart', JSON.stringify(this.cart))
            },
            resetpage() {
                this.active_step = 1;
                this.cart = {
                    customer:{},
                    current_item:{
                        species_id:'',
                        cut_id:'',
                        quality_id:'',
                        matching_id:'',
                        sheet_type_id:'',
                        size_id:'',
                        panel_substrate_id:'',
                        panel_thickness_id:'',
                        backer_id:'',
                        quantity:1,
                        custom_width:'',
                        custom_length:''
                    },
                    items:[],
                    skipped:0
                }
                localStorage.setItem('cart', JSON.stringify(this.cart))
            }
        },
        created() {
            axios.get(this.$host+'/api/get-formwood-data').then((res) => {
                this.settings =  JSON.parse(window.atob(res.data))
            });
            if(localStorage.getItem('cart')) {
               this.cart = JSON.parse(localStorage.getItem('cart'))
            } else {
                localStorage.setItem('cart', JSON.stringify(this.cart))
            }
        }
    };
</script>
