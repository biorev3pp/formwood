<template>
    <div>
        <div class="row row-wpanels justify-content-center gx-md-5">

            <div class="col-wpanels col-6 col-sm-6 col-md-6 col-xl-4 col-xxl-4 mb-3 mb-sm-4" v-for="s in category" :key="'category'+s.id">
                <input class="fw-product-builder-radio" type="radio" :id="'p-cat-'+s.id" name="category" :value="s.id" />
                <label :for="'p-cat-'+s.id" @click="selected_cat = s.id; size_id = ''; custom_width = ''; custom_length = ''; updateCategory()">
                    <div class="radio-img">
                        <fa-icon class="sel-check" icon="fa-solid fa-check" v-if="sstype == s.id"  />
                        <img class="img-fluid w-100" :src="$media+'components/'+s.image" :alt="s.name" />
                    </div>
                    <div class="radio-txt">{{s.name}}</div>
                </label>
            </div>

            <div class="col-wpanels col-12 col-sm-12 col-xxl-4 mb-3 mb-sm-4">
                <div class="row" v-if="selected_cat">
                    <div class="col-sm-6 col-lg-5 mb-2 mb-lg-0">
                        <div class="fw-drager p-block mb-2">
                            <h4 class="mb-3 fwp-size-h">Size</h4>
                            <div class="custom-radiobtn" v-for="sz in sizes" :key="'size-'+sz.id">
                                <input type="radio" :id="'panel_drager'+sz.id" name="panel_drager" v-model="size_id" :value="sz.id" @change="updateCategory()" />
                                <label :for="'panel_drager'+sz.id">{{sz.width}} x {{sz.length}}</label>
                            </div>
            
                            <div class="custom-radiobtn">
                                <input type="radio" id="panel_drager_custom" name="panel_drager" v-model="size_id" :value="0" @change="updateCategory()" />
                                <label for="panel_drager_custom">Custom Size</label>

                                <div class="form-group cst-sz" v-if="size_id === 0">
                                    <span class="form-control-cus d-flex mb-3">
                                        <input id="field_c1" v-model="custom_width" type="text" autocomplete="custom-size" name="c1" class="form-control custom-size1" @change="updateCategory()"> 
                                        <span class="mult-sign">X</span>
                                        <input id="field_c2" v-model="custom_length" type="text" autocomplete="custom-size" name="c2" class="form-control custom-size2" @change="updateCategory()"> 
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-7 mb-3 mb-lg-0">
                        <div class="form-group">
                            <span class="form-control-spe select-slicing">
                                <input type="number" min="1" class="form-control valid" name="slicing" aria-invalid="false" v-model="quantity" @keyup="updateCategory()" />
                                <label>Select quantity</label>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ProductCategories",
        props: {
            cart:Object
        },
        data() {
            return {
                category: [],
                allsizes:[],
                sizes:[],
                size_id:'',
                selected_cat:'',
                quantity:'',
                custom_width:'',
                custom_length:''
            };
        },
        computed: {
            sstype() {
                if(this.cart.current_item.sheet_type_id) {
                    this.selected_cat = this.cart.current_item.sheet_type_id
                    return this.cart.current_item.sheet_type_id
                } else {
                    return 0;
                }
            },
            ssize() {
                if(this.cart.current_item.size_id) {
                    this.size_id = this.cart.current_item.size_id
                    return this.cart.current_item.size_id
                } else {
                    return '';
                }
            }
        },
        watch: {
            selected_cat(nvalue, ovalue) {
                if(nvalue && ovalue != nvalue) {
                    this.sizes = this.allsizes.filter((ele) => {
                        return ele.sheet_type_id == nvalue
                    })
                }
            }
        },
        methods:{
            updateCategory() {
                this.$emit('updatesize', this.selected_cat, this.size_id, this.custom_width, this.custom_length, this.quantity)
            }
        }, 
        created() {
            axios.get(this.$host+'/api/get-category-options').then((res) => {
                let data =  JSON.parse(window.atob(res.data))
                this.category = data.category;
                this.allsizes = data.sizes;
            })
            if(this.cart.current_item.size_id >= 0) {
                this.size_id = this.cart.current_item.size_id
            }
            if(this.cart.current_item.quantity) {
                this.quantity = this.cart.current_item.quantity
            }
            if(this.cart.current_item.custom_width) {
                this.custom_width = this.cart.current_item.custom_width
            }
            if(this.cart.current_item.custom_length) {
                this.custom_length = this.cart.current_item.custom_length
            }
        }
    };
</script>
