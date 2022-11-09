<template>
    <div>
        <form class="mb-5 sel-1">
            <div class="row">
                <div class="col-sm-12 col-lg-12 mb-2 mb-lg-0">
                    <div class="form-group">
                        <span class="form-control-spe select-matching">
                            <label>Select matching</label>
                            <v-select :options="matchings" placeholder="Select Your Option" :clearable="false" :searchable="true" code="id"  label="name" @input="updateField" :reduce="(option) => option.id" v-model="mid"></v-select>
                        </span>
                    </div>
                </div>
            </div>
        </form>

        <div class="row row-wmatching justify-content-center">
            <div class="col-quality col-6 col-md-4  mb-1 mb-sm-4" v-for="s in matchings" :key="'matching'+s.id" :id="'match'+s.id">
                <input class="fw-product-builder-radio" type="radio" :id="'fw-wmatching-'+s.id" name="wmatching" data-delete="Maple" :value="s.id" :checked="s.id == mid" />
                <label :for="'fw-wmatching-'+s.id" @click="mid=s.id; $emit('updatematching', 'matching_id', s.id)">
                    <div class="radio-img">
                        <div class="wmatching-card-hover">
                            <span>
                                Choose this<br />
                                matching
                            </span>
                        </div>
                        <fa-icon class="sel-check" icon="fa-solid fa-check" v-if="mid == s.id" /> 
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
        name: "Matching",
        props: {
            cart:Object,
        },
        components: {
            'vue-load-image': VueLoadImage
        },
        data() {
            return {
                matchings: [],
                loader:this.$host+'/images/spinner.gif',
                mid:''
            };
        },
        methods: {
            updateField() {
                this.$emit('updatematching', 'matching_id', this.mid)
                const element = document.querySelector('#match'+this.mid);
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
            axios.get(this.$host+'/api/get-matching-options/'+window.btoa(this.cart.current_item.cut_id)).then((res) => {
                this.matchings =  JSON.parse(window.atob(res.data))
            })
            if(this.cart.current_item.matching_id) {
                this.mid = this.cart.current_item.matching_id
            }
        }
    };
</script>
