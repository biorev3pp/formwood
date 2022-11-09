<template>
    <div>
        <form class="mb-5 sel-1">
            <div class="row">
                <div class="col-sm-12 col-lg-12 mb-2 mb-lg-0">
                    <div class="form-group">
                        <span class="form-control-spe select-spe">
                            <label class="search-select">Select species and attribute</label>
                            <v-select :options="species" placeholder="Select Your Option" :clearable="false" :searchable="true" code="id"  label="name" @input="updateField" :reduce="(option) => option.id" v-model="spid"></v-select>
                        </span>
                    </div>
                </div>
            </div>
        </form>

        <div class="row row-species justify-content-center gx-md-5 gy-md-4">
            <div class="col-species col-6 col-md-4 mb-3 mb-sm-4" v-for="s in species" :key="'specie'+s.id" :id="'specie'+s.id">
                <input class="fw-product-builder-radio" type="radio" :id="'fw-wspecies'+s.id" name="wspecies" data-delete="Maple" :value="s.id" :checked="s.id == spid" />
                <label :for="'fw-wspecies'+s.id" @click="spid = s.id; $emit('updatespecies', 'species_id', s.id)">
                    <div class="radio-img">
                        <div class="species-card-hover">
                            <span>
                                Choose this<br />wood species
                            </span>
                        </div>
                        <fa-icon class="sel-check" icon="fa-solid fa-check" v-if="spid == s.id" />
                        <vue-load-image>
                            <img slot="image" class="img-fluid w-100" :src="$media+'components/'+s.image" :alt="s.name" />
                            <img slot="preloader" class="img-fluid inner-loader" :src="loader" :alt="s.name" />
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
        name: "Species",
        props: {
            cart:Object
        },
        components: {
            'vue-load-image': VueLoadImage,
        },
        data() {
            return {
                species: [],
                loader:this.$host+'/images/spinner.gif',
                spid:''
            };
        },
        methods: {
            updateField() {                
                this.$emit('updatespecies', 'species_id', this.spid)
                const element = document.querySelector('#specie'+this.spid);
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
            axios.get(this.$host+'/api/get-species-options').then((res) => {
                this.species =  JSON.parse(window.atob(res.data))
            })
            if(this.cart.current_item.species_id) {
                this.spid = this.cart.current_item.species_id
            }
        }
    };
</script>