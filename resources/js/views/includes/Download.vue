<template>
    <div>
        <div class="row mb-6 justify-content-center" id="visitor-info" data-layout="1">
            <div class="col-12 text-wrapper">
                <div class="row g-xs-2">
                    <div class="col-12 col-sm-6">
                        <div class="form-group mb-4">
                            <span class="form-control-con">
                                <input class="form-control" :class="(all_mfields.indexOf('name') >= 0)?'required':''" type="text" @change="updateCustomer()" v-model="customer.name" />
                                <label>Name *</label>
                            </span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group mb-4">
                            <span class="form-control-con">
                                <input class="form-control"  :class="(all_mfields.indexOf('email') >= 0)?'required':''" type="email" @change="updateCustomer()" v-model="customer.email" />
                                <label>E-mail *</label>
                            </span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group mb-4">
                            <span class="form-control-con">
                                <input class="form-control" type="tel"  :class="(all_mfields.indexOf('phone') >= 0)?'required':''"  @change="updateCustomer()" v-model="customer.phone" />
                                <label>Phone</label>
                            </span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group mb-4">
                            <span class="form-control-con">
                                <input class="form-control " type="text"  :class="(all_mfields.indexOf('company') >= 0)?'required':''"  @change="updateCustomer()" v-model="customer.company" />
                                <label>Company Name</label>
                            </span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group mb-4">
                            <span class="form-control-con">
                                <input class="form-control " type="text"  :class="(all_mfields.indexOf('address') >= 0)?'required':''"  @change="updateCustomer()" v-model="customer.address_line_1" />
                                <label>Address Line 1</label>
                            </span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group mb-4">
                            <span class="form-control-con">
                                <input class="form-control " type="text" @change="updateCustomer()" v-model="customer.address_line_2" />
                                <label>Address Line 2</label>
                            </span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group mb-4">
                            <span class="form-control-con">
                                <input class="form-control"  :class="(all_mfields.indexOf('city') >= 0)?'required':''"  type="text" @change="updateCustomer()" v-model="customer.city" />
                                <label>City</label>
                            </span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group mb-4">
                            <span class="form-control-con">
                                <input class="form-control "  :class="(all_mfields.indexOf('state') >= 0)?'required':''"  type="text" @change="updateCustomer()" v-model="customer.state" />
                                <label>State</label>
                            </span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group mb-4">
                            <span class="form-control-con">
                                <input class="form-control "  :class="(all_mfields.indexOf('zipcode') >= 0)?'required':''"  type="text" @change="updateCustomer()" v-model="customer.postal_code" />
                                <label>Zip Code</label>
                            </span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group mb-4">
                            <span class="form-control-con">
                                <input class="form-control "  :class="(all_mfields.indexOf('country') >= 0)?'required':''"  type="text" @change="updateCustomer()" v-model="customer.country" />
                                <label>Country</label>
                            </span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12">
                        <div class="form-group mb-4">
                            <span class="form-control-con">
                                <textarea rows="4" class="form-control"  :class="(all_mfields.indexOf('remarks') >= 0)?'required':''"  @change="updateCustomer()" v-model="customer.remarks"></textarea> 
                                <label>Remarks</label> 
                            </span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 file-att">
                        <div class="upload-button" aria-hidden="true">
                            <fa-icon icon="fa-solid fa-paperclip" class="pclip" /> {{ imagelabel }}
                        </div>
                        <input type="file" class="fileupload-input" multiple id="myfile" ref="attachments" name="file[]" @change="uploadFile" />
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-8">
                                <div class="form-group mb-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" @change="updateCustomer()" v-model="customer.privacy" value="1" class="form custom-control-input" id="privacy" />
                                        <label for="privacy" class="custom-control-label" v-if="tlink">I agree with the <a class="plink" :href="tlink" target="_blank">Terms &amp; Conditions</a>*</label>
                                        <label for="privacy" class="custom-control-label" v-else>I agree with the Terms &amp; Conditions*</label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-sm-12 col-md-4 d-flex add-pr">
                                <button type="button" class="btn btn-primary add-prdt" @click="anotherProduct()" v-if="loader == false">Add another product</button>
                                <button type="button" class="btn btn-primary sbmt" @click="validateForm()"   v-if="loader">
                                    <span class="spinner-border spinner-border-sm"  role="status" aria-hidden="true"></span>
                                    Submitting...
                                </button>
                                <button type="button" class="btn btn-primary sbmt" @click="validateForm()" v-else> Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12 mt-3 sel-prdts">
                            <h5>Selected Products</h5>
                            <ol class="selected-p">
                                <li v-for="(ci, ck) in all_items" :key="'cartitem'+ck">
                                    <label class="checkbox-item">
                                       {{ ci }}
                                    </label>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Form from 'vform'
    export default {
        name: "Download",
        props: {
            cart:Object,
            tlink:String,
            mfields:String
        },
        data() {
            return {
                loader:false,
                imagelabel: 'Attach files (jpg, png, pdf, doc) here',
                customer:{
                    name:'',
                    email:'',
                    phone:'',
                    company:'',
                    address_line_1:'',
                    address_line_2:'',
                    city:'',
                    state:'',
                    postal_code:'',
                    country:'',
                    remarks:'',
                    privacy:0
                },
                cerror:{

                },
                all_items:[],
                form: new Form({
                    attachments:[],
                    cr:{},
                    it:[],
                    ci:{}
                })
            };
        },
        computed: {
            all_mfields() {
                return this.mfields.split(',');
            }
        },
        methods: {
            uploadFile() {
                let files = this.$refs.attachments.files;
                if (!files.length) {
                    return false;
                }

                for (let i = 0; i < files.length; i++) {
                    this.form.attachments.push(files[i]);
                }

                this.imagelabel = (files.length == 1)?'1 file is attached.':files.length+' files are attached.';
            },
            anotherProduct() {
                this.$swal.fire({
                    title: 'Do you want to save the changes?',
                    showCancelButton: true,
                    confirmButtonText: 'Save',
                    denyButtonText: `Don't save`,
                    }).then((result) => {
                    if (result.isConfirmed) {
                       this.$emit('anotherproduct')
                    }
                })
            },
            validateForm() {
                let fields = this.mfields.split(',');
                if(fields.indexOf('email') >= 0) 
                {
                    if(this.customer.email == '') {
                        this.$toast.error('Name and email are mandatory fields.');
                        return false;
                    }
    
                    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    
                    if(!this.customer.email.match(mailformat)) {
                        this.$toast.error('Please enter correct email.');
                        return false;
                    }
                }

                if(fields.indexOf('email') >= 0) 
                {
                    if(this.customer.email == '' || this.customer.name == '') {
                        this.$toast.error('Name and email are mandatory fields.');
                        return false;
                    }
    
                    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    
                    if(!this.customer.email.match(mailformat)) {
                        this.$toast.error('Please enter correct email.');
                        return false;
                    }
                }

                if(this.customer.privacy == 0) {
                    this.$toast.error('Please read and accept terms &amp; conditions..');
                    return false;
                }
                this.loader = true;

                this.form.cr = window.btoa(JSON.stringify(this.cart.customer))
                this.form.it = window.btoa(JSON.stringify(this.cart.items))
                this.form.ci = window.btoa(JSON.stringify(this.cart.current_item))

                let config = {};

                if(this.form.attachments.length) {
                    config = { 
                        headers: { 
                            'Content-Type': 'multipart/form-data',
                            'charset': 'utf-8',
                            'boundary': Math.random().toString().substr(2)
                        } 
                    };
                } else {
                    config = { 
                        headers: { 
                            'charset': 'utf-8',
                        } 
                    };
                }

                this.form.post(this.$host+'/api/submit-query', config).then((res) => {
                    this.$swal.fire({
                        icon: 'success',
                        title: 'Query Submitted',
                        html: '<p>Your query has been submitted successfully.<br>One of our representative will connect with you at the earliest.</p>',
                        footer: 'Thank for visiting Formwood',
                        showClass: {
                            popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                            popup: 'animate__animated animate__fadeOutUp'
                        },
                        timer: 6000,
                        timerProgressBar: true,
                    })
                    this.form.attachments = []
                    this.form.cr = {}
                    this.form.it = []
                    this.form.ci = {}
                    this.$emit('resetpage')
                })
            },
            updateCustomer() {
                this.$emit('updatecustomer', this.customer)
            }
        },
        created() {
            if(Object.keys(this.cart.customer).length) {
                this.customer = this.cart.customer
            }
            axios.post(this.$host+'/api/get-item-string', {string:window.btoa(JSON.stringify(this.cart))}).then((res) => {
                this.all_items =  JSON.parse(window.atob(res.data))
            })
        }
    };
</script>
