<template>
    <div>
        <div class="row row-wpanels justify-content-center gx-md-5">
            <div class="col-md-6 mb-3 mb-sm-4">
                <div class="fw-substrate p-block mb-2">
                    <h4 class="mb-3 fwp-size-h">Substrate</h4>
                    <div class="custom-radiobtn" v-for="s in substrates" :key="'ps'+s.id">
                        <input type="radio" :id="'substrate'+s.id" name="substrate" v-model="panel_substrate_id" :value="s.id" @change="updateOptions()" />
                        <label :for="'substrate'+s.id">{{s.name}}</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3 mb-sm-4">
                <div class="fw-thickness p-block mb-2" v-if="panel_substrate_id">
                    <h4 class="mb-3 fwp-size-h">Core Thickness</h4>
                    <div class="custom-radiobtn" v-for="t in corethickness" :key="'pt'+t.id">
                        <input type="radio" :id="'thickness'+t.id" name="thickness"  v-model="panel_thickness_id"  :value="t.id" @change="updateOptions()" />
                        <label :for="'thickness'+t.id">{{t.name}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "Core-options",
        props: {
            cart:Object,
        },
        data() {
            return {
                panel_substrate_id: '',
                panel_thickness_id: '',
                substrates:[],
                thickness:[],
            };
        },
        computed: {
            activesubstrate() {
                return this.substrates.find(ele => ele.id == this.panel_substrate_id)
            },
            corethickness() {
                if(this.activesubstrate) {
                    let thd = this.activesubstrate.thickness_ids.split(',')
                    thd = thd.map(Number)
                    return this.thickness.filter((ele) => {
                        return thd.indexOf(ele.id) >= 0
                    })
                } else {
                    return []
                }
            }
        },
        methods:{
            updateOptions() {
                this.$emit('updateoption', this.panel_substrate_id, this.panel_thickness_id)
            }
        }, 
        created() {
            axios.get(this.$host+'/api/get-panel-options').then((res) => {
                let data =  JSON.parse(window.atob(res.data))
                this.substrates = data.substrates
                this.thickness = data.thickness
            })
            if(this.cart.current_item.panel_substrate_id) {
                this.panel_substrate_id = this.cart.current_item.panel_substrate_id
            }
            if(this.cart.current_item.panel_thickness_id) {
                this.panel_thickness_id = this.cart.current_item.panel_thickness_id
            }
        }
    };
</script>
