<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-7 mb-1 mb-sm-4">
                <div class="fw-backer p-block mb-2">
                    <h4 class="mb-3 fwp-size-h">Backer</h4>
                    <div v-if="backers.length">
                        <div class="custom-radiobtn" v-for="b in backers" :key="'backerdiv'+b.id">
                            <input type="radio" :id="'backer'+b.id" name="backer" :value="b.id" v-model="backer_id" @change="updateBacker()" />
                            <label :for="'backer'+b.id">{{b.name}}</label>
                        </div>
                    </div>
                    <div v-else>
                        <p>No Backer option available based on your selection.<br>
                            You can continue or you can go back to view options by changing product category and relevent size </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "Backer",
        props: {
            cart:Object,
        },
        data() {
            return {
                backer_id: '',
                backers:[]
            };
        },
        methods:{
            updateBacker() {
                this.$emit('updatebaker', 'backer_id', this.backer_id)
            }
        },
        created() {
            axios.get(this.$host+'/api/get-backer-options/'+window.btoa(this.cart.current_item.size_id)).then((res) => {
                this.backers =  JSON.parse(window.atob(res.data))
            })
            if(this.cart.current_item.backer_id) {
                this.backer_id = this.cart.current_item.backer_id
            }
        }
    };
</script>
