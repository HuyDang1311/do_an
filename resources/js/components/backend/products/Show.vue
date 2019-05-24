<template>
    <div class="main-content">
        <div class="container-fluid">
            <h3 class="page-title">Product</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading" style="padding-bottom: 7px;">
                            <div class="panel-title">
                                <div class="col-md-12">
                                    <i class="fa fa-search"></i>
                                    <span>SHOW PRODUCT</span>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <table class="table table-show">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="text-right detail-item">
                                                Name :
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{product.name}}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="text-right detail-item">
                                                Cat :
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{product.category && product.category.name}}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="table-last-tr">
                                        <td>
                                            <div class="text-right detail-item">
                                                Price :
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                {{product.price | numeral('0,0')}} VNĐ
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="table-last-tr">
                                        <td>
                                            <div class="text-right detail-item">
                                                Images :
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <img v-for="(product_image, index) in product.product_images" style="width: 150px; height: 100px;" :src="'/storage/images/products/' + product_image.name" alt="">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ProductRequest from '../../../Request/ProductRequest';
    export default {
        name: "Show",
        data () {
            return {
                product: {},
            }
        },
        created: function () {
            let id = this.$route.params.id;
            this.showProduct(id);
        },
        methods: {
            showProduct (id) {
                ProductRequest.showById(id)
                    .then(response => {
                        let status = response.status_code;
                        if (status == 200) {
                            this.product = response.data;
                        } else if (status == 404) {

                        }
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
        }
    }
</script>

<style scoped>

</style>