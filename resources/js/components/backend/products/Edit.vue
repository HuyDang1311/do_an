<template>
    <div class="main-content">
        <div class="container-fluid">
            <h3 class="page-title">PRODUCT</h3>
            <div class="row">
                <div class="col-md-12">
                    <!-- BORDERED TABLE -->
                    <div class="panel">
                        <div class="panel-heading" style="padding-bottom: 7px;">
                            <div class="panel-title">
                                <div class="col-md-6 col-sm-6" style="padding-left: 0px">
                                    <i class="fa fa-search"></i>
                                    <span>EDIT PRODUCT</span>
                                </div>
                                <div class="col-md-6 col-sm-6 text-right" style="padding-right: 0px">
                                    <router-link :to="{name: 'products'}">
                                        <a class="show-list" href="#">
                                            <i class="fa fa-list-ol" aria-hidden="true"></i> <span class="">Show list</span>
                                        </a>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-offset-3 col-md-6">
                                <div class="form-group">
                                    <label for="code">Code</label>
                                    <input type="text" id="code" class="form-control" v-model="code">
                                    <p class="error-message" v-if="errors.code">{{errors.code[0]}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control" id="category" v-model="cat_id">
                                        <option disabled selected>Choose...</option>
                                        <option v-for="(category, index) in categories" :value="category.id">{{category.name}}</option>
                                    </select>
                                    <p class="error-message" v-if="errors.cat_id">{{errors.cat_id[0]}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" class="form-control" v-model="name">
                                    <p class="error-message" v-if="errors.name">{{errors.name[0]}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" id="price" class="form-control" v-model="price">
                                    <p class="error-message" v-if="errors.price">{{errors.price[0]}}</p>
                                    <p class="error-message" v-if="priceErrorMes">{{priceErrorMes}}</p>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <vue-upload-multiple-image
                                        @upload-success="uploadImageSuccess"
                                        @before-remove="beforeRemove"
                                        @edit-image="editImage"
                                        @data-change="dataChange"
                                        :dragText="'Drag many images'"
                                        :browseText="'(or) choose'"
                                        :dataImages="images"
                                ></vue-upload-multiple-image>
                                </div>
                            </div>
                            <div class="col-md-12 text-center" style="margin-top: 15px">
                                <a  class="btn btn-primary" type="button" :class="canCreate ? '' : 'disabled'" style="height: 35px;" @click="createProduct">
                                    <i class="fa fa-plus"></i>
                                    <span class="hidden-xs">Create</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- END BORDERED TABLE -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CategoryRequest from '../../../Request/CategoryRequest';
    import ProductRequest from '../../../Request/ProductRequest';
    import VueUploadMultipleImage from 'vue-upload-multiple-image'
    import {Awn} from '@/utils/awn';
    export default {
        name: "Create",
        components: {
            VueUploadMultipleImage
        },
        data() {
            return {
                categories: [],
                code: '',
                cat_id: '',
                name: '',
                price: '',
                priceErrorMes: '',
                images: [],
                errors: {},
                canCreate: true,
            }
        },
        methods: {
            getCategories () {
                CategoryRequest.getAll()
                    .then(response => {
                        this.categories = response.data;
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            getProduct (id) {
                ProductRequest.showById(id)
                    .then(response => {
                        let status = response.status_code;
                        if (status == 200) {
                            let product = response.data;
                            this.code = product.code;
                            this.cat_id = product.cat_id;
                            this.name = product.name;
                            this.price = parseInt(product.price);
                            let productImages = product.product_images;
                            for (let i = 0; i < productImages.length; i++) {
                                this.images.push({
                                    path: 'http://' + window.location.hostname + '/storage/images/products/' + productImages[i].name,
                                    default: 10,
                                    highlight: i === 0 ? 1 : 0,
                                });
                            }
                        } else if (status == 404) {

                        }
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            uploadImageSuccess(formData, index, fileList) {
                console.log('uploadImageSuccess')
            },
            beforeRemove (index, done, fileList) {
                console.log('beforeRemove')
                done();
            },
            editImage (formData, index, fileList) {
                console.log('editImage')
            },
            dataChange (data) {
                console.log('dataChange')
            },
            createProduct () {
                let formData = new FormData();
                formData.append('code', this.code);
                formData.append('cat_id', this.cat_id);
                formData.append('name', this.name);
                formData.append('price', this.price);

                for (let i = 0; i < this.images.length; i++) {
                    formData.append('images[]', this.images[i]);
                }
                ProductRequest.create(formData)
                    .then(response => {
                        let statusCode = response.status_code;
                        if (statusCode == 422) {
                            this.errors = response.errors;
                            this.canCreate = false;
                            this.priceErrorMes = '';
                        } else if (statusCode == 201) {
                            Awn.success(this, 'Product', 'Product is created successfully.');
                            this.$router.push({name: 'products'});
                        }
                    })
                    .catch(error => {

                    });
            },
            checkFilledData () {
                if (this.code && this.cat_id && this.name && this.price && !isNaN(this.price) && this.images.length > 0) {
                    this.canCreate = true;
                } else {
                    this.canCreate = false;
                }
            }
        },
        created: function () {
            let id = this.$route.params.id;
            this.getCategories();
            this.getProduct(id);
        },
        watch: {
            // code: function (value) {
            //     this.checkFilledData();
            // },
            // cat_id: function (value) {
            //     this.checkFilledData();
            // },
            // name: function (value) {
            //     this.checkFilledData();
            // },
            // price: function (value) {
            //     if (isNaN(value)) {
            //         this.priceErrorMes = "The price must be an integer.";
            //     } else {
            //         this.priceErrorMes = '';
            //     }
            //     this.checkFilledData();
            // },
            // images: function (value) {
            //     this.checkFilledData();
            // }
        }
    }
</script>

<style scoped>

</style>