<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Products
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Products</a></li>
                <!--<li class="active">Dashboard</li>-->
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box panel-item">
                        <div class="box-header with-border">
                            <h3 class="box-title search-panel">
                                <i class="fa fa-search font-green"></i>
                                SEARCH PRODUCT
                            </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form v-on:submit.prevent="search" class="form-horizontal form-search">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="code" class="col-md-2 control-label">Code</label>
                                        <div class="col-md-10">
                                            <input v-model="searchData.code" type="text" class="form-control" id="code" placeholder="Code">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="col-md-2 control-label">Name</label>
                                        <div class="col-md-10">
                                            <input v-model="searchData.name" type="text" class="form-control" id="name" placeholder="Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Category</label>
                                        <div class="col-md-10">
                                            <select class="form-control select2" v-model="searchData.cat_id">
                                                <option disabled selected="">...Choose...</option>
                                                <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price" class="col-md-2 control-label">Price</label>
                                        <div class="col-md-10">
                                            <input v-model="searchData.price" type="text" class="form-control" id="price" placeholder="Price">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <a class="btn btn-default no-radius" @click="clear">
                                            <i class="fa fa-eraser"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-info">
                                            <i class="fa fa-search"></i> Search
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fa fa-product-hunt"></i>
                                PRODUCT LIST
                            </h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div v-show="products.length">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-custom">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px">Number</th>
                                            <th style="cursor: pointer" @click="sort('code')">
                                                Code
                                                <span>
                                                    <i v-if="sortColumn != 'code'" class="fa fa-sort"></i>
                                                    <i v-if="sortColumn == 'code' && sortDirection == 'asc'" class="fa fa-sort-asc"></i>
                                                    <i v-if="sortColumn == 'code' && sortDirection == 'desc'" class="fa fa-sort-desc"></i>
                                                </span>
                                            </th>
                                            <th style="cursor: pointer" @click="sort('name')">
                                                Name
                                                <span>
                                                    <i v-if="sortColumn != 'name'" class="fa fa-sort"></i>
                                                    <i v-if="sortColumn == 'name' && sortDirection == 'asc'" class="fa fa-sort-asc"></i>
                                                    <i v-if="sortColumn == 'name' && sortDirection == 'desc'" class="fa fa-sort-desc"></i>
                                                </span>
                                            </th>
                                            <th style="cursor: pointer" @click="sort('cat_id')">
                                                Category
                                                <span>
                                                    <i v-if="sortColumn != 'cat_id'" class="fa fa-sort"></i>
                                                    <i v-if="sortColumn == 'cat_id' && sortDirection == 'asc'" class="fa fa-sort-asc"></i>
                                                    <i v-if="sortColumn == 'cat_id' && sortDirection == 'desc'" class="fa fa-sort-desc"></i>
                                                </span>
                                            </th>
                                            <th style="cursor: pointer">Image</th>
                                            <th style="cursor: pointer" @click="sort('price')">
                                                Price
                                                <span>
                                                    <i v-if="sortColumn != 'price'" class="fa fa-sort"></i>
                                                    <i v-if="sortColumn == 'price' && sortDirection == 'asc'" class="fa fa-sort-asc"></i>
                                                    <i v-if="sortColumn == 'price' && sortDirection == 'desc'" class="fa fa-sort-desc"></i>
                                                </span>
                                            </th>
                                            <th style="cursor: pointer" @click="sort('created_at')">
                                                Created date
                                                <span>
                                                    <i v-if="sortColumn != 'created_at'" class="fa fa-sort"></i>
                                                    <i v-if="sortColumn == 'created_at' && sortDirection == 'asc'" class="fa fa-sort-asc"></i>
                                                    <i v-if="sortColumn == 'created_at' && sortDirection == 'desc'" class="fa fa-sort-desc"></i>
                                                </span>
                                            </th>
                                            <th style="width: 241px">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(product, index) in products">
                                            <td>{{ (pagination.current_page -1) * pagination.per_page + index + 1 }}</td>
                                            <td>{{ product.code }}</td>
                                            <td>{{ product.name }}</td>
                                            <td>{{ product.category && product.category.name }}</td>
                                            <td>@mdo</td>
                                            <td>{{ product.price | numeral('0,0') }} VNĐ</td>
                                            <td>{{ product.created_at }}</td>
                                            <td>
                                                <a class="btn btn-success no-radius">
                                                    <i class="fa fa-search hidd"></i>
                                                    <span class="hidden-    xs">Show</span>
                                                </a>
                                                <a class="btn btn-primary no-radius">
                                                    <i class="fa fa-edit"></i>
                                                    <span class="hidden-xs">Edit</span>
                                                </a>
                                                <a class="btn btn-danger no-radius">
                                                    <i class="fa fa-times"></i>
                                                    <span class="hidden-xs">Delete</span>
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class class="row">
                                    <div class="col-md-6 text-left">
                                        <p style="font-size: 15px;">Showing {{pagination.from}} to {{pagination.to}} of {{pagination.total}} records</p>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <pagination-component
                                            :pagination="pagination"
                                            :searchData="searchData"
                                            @changePaginationData="changePaginationData"
                                        >
                                        </pagination-component>
                                    </div>
                                </div>
                            </div>
                            <div v-show="products.length == 0" class="text-center" style="font-size: 15px">
                                No data
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <pulse-loader color="#32c5d2" :loading="isLoading" style="position: absolute;top: 358px;left: 1007px;"></pulse-loader>
        <!-- /.content -->
    </div>
</template>

<script>
    import Pagination from '../Pagination';
    import ProductRequest from '../../../Request/ProductRequest';
    import CategoryRequest from '../../../Request/CategoryRequest';
    import { PulseLoader } from 'vue-spinner/dist/vue-spinner.min.js'
    export default {
        name: "Table",
        components: {
            'pagination-component': Pagination,
            PulseLoader,
        },
        data() {
            return {
                products: [],
                categories: [],
                searchData: {
                    cat_id: null,
                    code: null,
                    name: null,
                    price: null,
                },
                pagination: {},
                sortColumn: null,
                sortDirection: null,
                isLoading: true,
            }
        },
        methods: {
            getProducts () {
                ProductRequest.getAll(this.searchData)
                    .then(response => {
                        let status = response.status_code;
                        if (status === 200) {
                            let responseData = response.data;
                            this.setData(responseData)
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            getCategories () {
                CategoryRequest.getAll()
                    .then(response => {
                        this.categories = response.data;
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            changePaginationData (paginationData) {
                this.setData(paginationData)
            },
            clear () {
                this.searchData.code = null;
                this.searchData.cat_id = null;
                this.searchData.name = null;
                this.searchData.price = null;
            },
            search () {
                this.isLoading = true;
                ProductRequest.getAll(this.searchData)
                    .then(response => {
                        let status = response.status_code;
                        if (status === 200) {
                            let responseData = response.data;
                            this.setData(responseData)
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            sort (sortColumn) {
                if (sortColumn !== this.sortColumn) {
                    this.sortDirection = null;
                }
                if (this.sortDirection === 'desc') {
                    this.sortDirection = 'asc'
                } else {
                    this.sortDirection = 'desc'
                }
                this.sortColumn = sortColumn;
                this.searchData.sort_column = sortColumn;
                this.searchData.sort_direction = this.sortDirection;
                this.isLoading = true;
                ProductRequest.getAll(this.searchData)
                    .then(response => {
                        let status = response.status_code;
                        if (status === 200) {
                            let responseData = response.data;
                            this.setData(responseData)
                        }
                    })
                    .catch(error => {
                        console.log(error)
                    });
            },
            setData (data) {
                this.products = data.data;
                this.pagination = {
                    from: data.from,
                    to: data.to,
                    per_page: data.per_page,
                    total_page: data.last_page,
                    path: data.path,
                    current_page: data.current_page,
                    total: data.total,
                }
                this.isLoading = false;
            }
        },
        created: function () {
            this.getProducts();
            this.getCategories();
        },
    }
</script>

<style scoped>

</style>