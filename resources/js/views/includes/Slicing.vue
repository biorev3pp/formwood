<template>
    <div>
        <form class="mb-5 sel-1">
            <div class="row">
                <div class="col-sm-12 col-lg-12 mb-2 mb-lg-0">
                    <div class="form-group">
                        <span class="form-control-spe select-slicing">
                            <label>Select Slicing Technique</label>
                            <v-select :options="cuts" placeholder="Select Your Option" :clearable="false" :searchable="true" code="id"  label="name" @input="updateField" :reduce="(option) => option.id" v-model="cid"></v-select>
                        </span>
                    </div>
                </div>
            </div>
        </form>

        <div class="row row-slicing justify-content-center gx-md-5 gy-md-4">
            <div class="col-slicing col-6 col-md-4 mb-3 mb-sm-4" v-for="s in cuts" :key="'cut'+s.id" :id="'cut'+s.id">
                <input class="fw-product-builder-radio" type="radio" :id="'fw-slicing-'+s.id" name="slicing" data-delete="Maple" :value="s.id" :checked="s.id == cid" />
                <label :for="'fw-slicing-'+s.id" @click="cid = s.id; $emit('updatecuts', 'cut_id', s.id)">
                    <div class="radio-img">
                        <div class="slicing-card-hover">
                            <span>
                                Choose this<br />
                                slicing technique
                            </span>
                        </div>
                        <fa-icon class="sel-check" icon="fa-solid fa-check" v-if="cid == s.id" /> 
                        <vue-load-image>
                            <img slot="image" class="img-fluid w-100" :src="$media+'components/'+s.image" :alt="s.name" />
                            <img slot="preloader"  class="img-fluid inner-loader" :src="loader" :alt="s.name" />
                            <div slot="error">No Image Found</div>
                        </vue-load-image>
                    </div>
                    <div class="radio-txt match-height">{{s.name}}</div>
                </label>
            </div>
        </div>
    </div>
</template>
<script>
    import VueLoadImage from 'vue-load-image'

    export default {
        name: "Slicing",
        props: {
            cart:Object,
        },
        components: {
            'vue-load-image': VueLoadImage
        },
        data() {
            return {
                cuts: [],
                loader:this.$host+'/images/spinner.gif',
                cid:''
            };
        },
        methods: {
            updateField() {
                this.$emit('updatecuts', 'cut_id', this.cid)
                const element = document.querySelector('#cut'+this.cid);
                const rect = element.getBoundingClientRect();
                let offsetTop = rect.top + document.body.scrollTop;

                const ele = document.querySelector('#mainCntWrap');
                ele.scrollTo({
                    top: offsetTop-110,
                    behavior: 'smooth',
                })
            }
        },
        created() {
            axios.get(this.$host+'/api/get-cut-options/'+window.btoa(this.cart.current_item.species_id)).then((res) => {
                this.cuts =  JSON.parse(window.atob(res.data))
            })
            if(this.cart.current_item.cut_id) {
                this.cid = this.cart.current_item.cut_id
            }
        }
    };
</script>
