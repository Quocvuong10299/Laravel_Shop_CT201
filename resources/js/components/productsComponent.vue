<template>
    <div class="main position-relative">
        <div class="row w-100 mx-0">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-white px-0 mx-0 d-flex justify-content-end">
                <button @click="is_add = true" class="btn btn-success my-1 mr-2">Thêm mới</button>
            </div>
        </div>
        <!--show category data-->
        <div class="container-fluid banner__component px-0">
            <div style="height: 400px" class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên SP</th>
                        <th scope="col">Loại SP</th>
                        <th scope="col">Dành cho</th>
                        <th scope="col">Thương hiệu</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(pro, index) in products" :key="pro.product_id">
                        <th scope="row">{{pro.product_id}}</th>
                        <td>{{pro.product_name}}</td>
                        <td>{{pro.category_name}}</td>
                        <td>{{pro.category_gender_name}}</td>
                        <td>{{pro.supplier_name}}</td>
                        <td :class="(pro.product_active === 1) ? 'text-success' : 'text-danger'">{{(pro.product_active
                            === 1) ? 'còn hàng' : 'hết hàng'}}
                        </td>
                        <td>
                            <button @click.prevent="showDetail= true;showDetailProduct(index)" class="btn btn-info"><i
                                class="fa fa-eye" aria-hidden="true"></i></button>
                            <button
                                @click="showProduct = true;
                                  setValPro(
                                     pro.product_id,
                                     pro.product_name,
                                     pro.category_name,
                                     pro.category_id,
                                     pro.category_gender_id,
                                     pro.supplier_id,
                                     pro.supplier_name,
                                     pro.product_image,
                                     pro.product_description,
                                     pro.product_active,
                                     pro.product_new,
                                     pro.product_show
                                       )"
                                class="btn btn-warning">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--pagination-->
        <div class="component d-flex justify-content-center mt-5">
            <!--pagination using ajax -->
            <paginate v-if="pagination_pro.current_page > 0"
                      :pageCount="pagination_pro.last_page"
                      :containerClass="'pagination'"
                      :page-class="'page-item'"
                      :page-range="5"
                      :margin-pages="2"
                      :page-link-class="'page-link'"
                      :prev-class="'page-item'"
                      :prev-link-class="'page-link'"
                      :next-class="'page-item'"
                      :next-link-class="'page-link'"
                      :prev-text="'<'"
                      :next-text="'>'"
                      :first-last-button="false"
                      :clickHandler="clickCallback_pro">
            </paginate>
        </div>
        <!--edit product-->
        <div class="edit_pro" v-if="showProduct" :class="{show_edit_pro: showProduct}">
            <div class="form_edit_pro">
                <h1>Edit The Product</h1>
                <form @submit.prevent="">
                    <input type="hidden" disabled class="form-control" :value="this.pro_id" id="pro_id" name="id"
                           required>
                    <div class="form-group">
                        <label for="pro_name">Tên Sản Phẩm</label>
                        <input type="text" class="form-control" :value="this.pro_name" id="pro_name" placeholder="Name"
                               required/>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Danh mục</label>
                            <select class="form-control" id="">
                                <option :value="this.pro_cat_id" disabled selected>{{this.pro_cat_name}}</option>
                                <option v-for="pro_parents in category" :value="pro_parents.category_id">
                                    {{pro_parents.category_name}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="cat_gender">Dành cho</label>
                            <select class="form-control" id="cat_gender" name="cat_gender">
                                <option :value="this.pro_gender" disabled selected> {{(this.pro_gender === 1 ? 'Nam' :
                                    'Nữ')}}
                                </option>
                                <option value="1">Nam</option>
                                <option value="2">Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Thương hiệu</label>
                            <select class="form-control" id="pro_supplier" name="pro_supplier">
                                <option :value="this.pro_supplier_id" disabled selected></option>
                                <!--                                <option v-for="supplier in products" :value="supplier.supplier_id">{{supplier.supplier_name}}</option>-->
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">Tồn kho</label>
                            <select class="form-control" name="">
                                <option value="" disabled selected></option>
                                <option value="1">Còn Hàng</option>
                                <option value="0">Hết Hàng</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="">SP mới</label>
                            <select class="form-control" name="">
                                <option value="" disabled selected></option>
                                <option value="1">Mới</option>
                                <option value="0">Cữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="cat_show">Ẩn / Hiện</label>
                            <select class="form-control" id="cat_show" name="cat_show">
                                <option value="" disabled selected></option>
                                <option value="1">Hiện</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                    </div>
                    <!--                    <div class="form-group">-->
                    <!--                        <label>Mô Tả</label>-->
                    <!--                        <ckeditor v-model="editorData" :config="editorConfig"></ckeditor>-->
                    <!--                    </div>-->
                    <button type="submit" class="btn bg-light" @click="showProduct = false">Hủy</button>
                    <button type="submit" class="btn btn-success">Lưu</button>
                </form>
            </div>
            <div class="overlay_form"></div>
        </div>
        <!--see detail product-->
        <div>
            <div v-if="showDetail" :class="{active_showdetail_product : showDetail}"
                 class="position-absolute w-100 detail_product">
                <h5>Chi tiết sản phẩm</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-sm">
                        <thead>
                        <tr>
                            <!--<input type="hidden" disabled class="form-control" id="det_id" name="det_id" required :value="this.det_id">-->
                            <th scope="col">Image</th>
                            <th scope="col">Đơn vị</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Mới</th>
                            <th scope="col">Thời gian tạo</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(prod, index) in data_pro_detail" :key="prod.product_id">
                            <td><img width="80" height="80" :src="prod.product_image"/></td>
                            <td>Cái</td>
                            <td style="max-width: 20rem">{{prod.product_description}}</td>
                            <td>{{(prod.product_new === 1) ? 'Mới' : 'Cũ' }}</td>
                            <td>{{prod.created_at}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <button @click="showDetail = false" class="btn btn-warning mx-2">Back</button>
            </div>
        </div>

        <!--        add product-->
        <div style="overflow-y: scroll; height: 100%" class="add_pro" v-if="is_add" :class="{active_add_pro: is_add}">
            <div class="form_edit_pro">
                <h1>Add The Product</h1>
                <form @submit.prevent="">
                    <input type="hidden" disabled class="form-control" id="id_add" name="id_add" required>
                   <div class="d-flex justify-content-between">
                       <div class="form-group">
                           <label for="pro_name_add">Tên Sản Phẩm</label>
                           <input v-model="newPro.name" type="text" class="form-control" id="pro_name_add"
                                  placeholder="Name" required/>
                       </div>
                       <div class="form-group">
                           <label for="pro_item">Danh mục</label>
                           <select v-model="newPro.category_id" class="form-control" id="pro_item" name="pro_item">
                               <option value="" disabled selected> Chọn Danh Mục</option>
                               <option v-for="(categorys, index) in category" :value="categorys.category_id">
                                   {{categorys.category_name}}
                               </option>
                           </select>
                       </div>
                       <div class="form-group">
                           <label for="">Thương hiệu</label>
                           <select v-model="newPro.supplier_id" class="form-control" name="pro_supplier">
                               <option disabled selected></option>
                               <option v-for="(suppliers, index) in supplier" :value="suppliers.supplier_id">
                                   {{suppliers.supplier_name}}
                               </option>
                           </select>
                       </div>
                   </div>
                   <div class="d-flex justify-content-between">
                       <div class="form-group">
                           <label for="pro_gender">Dành cho</label>
                           <select v-model="newPro.category_gender_id" class="form-control" id="pro_gender" name="pro_gender">
                               <option value="" disabled selected></option>
                               <option value="1">Nam</option>
                               <option value="2">Nữ</option>
                           </select>
                       </div>
                       <div class="form-group">
                           <label for="">Trạng thái</label>
                           <select v-model="newPro.product_active" class="form-control" name="">
                               <option disabled selected>Trạng Thái</option>
                               <option value="1" class="text-success">Còn Hàng</option>
                               <option value="0" class="text-danger">Hết Hàng</option>
                           </select>
                       </div>
                       <div class="form-group">
                           <label for="">SP mới</label>
                           <select v-model="newPro.product_new" class="form-control" name="pro_new">
                               <option disabled selected>Sản Phẩm Mới</option>
                               <option value="1">Mới</option>
                               <option value="0">Cũ</option>
                           </select>
                       </div>
                       <div class="form-group">
                           <label for="cat_show">Ẩn / Hiện</label>
                           <select v-model="newPro.show" class="form-control" id="" name="cat_show">
                               <option value="" disabled selected></option>
                               <option value="1">Hiện</option>
                               <option value="0">Ẩn</option>
                           </select>
                       </div>
                   </div>
                    <div class="form-group">
                        <label>Mô Tả</label>
                        <ckeditor v-model="newPro.product_description" :config="editorConfig"></ckeditor>
                    </div>
                    <button type="submit" class="btn bg-light" @click="is_add = false">Hủy</button>
                    <button type="submit" class="btn btn-success" @click.prevent="createProduct()">Lưu</button>
                </form>
            </div>
<!--            <div class="overlay_form"></div>-->
        </div>

    </div>
</template>

<script>
    import Paginate from 'vuejs-paginate';
    import {RESOURCE} from '../api';
    import CKEditor from 'ckeditor4-vue';

    export default {
        name: "products-component",
        components: {
            Paginate,
            CKEditor
        },
        data() {
            return {
                products: [],
                category: [],
                gender: [],
                supplier:[],
                pagination_pro: {},
                showProduct: false,
                showDetail: false,
                is_add: false,
                data_pro_detail: [],
                newPro: {
                    name: '',
                    category_id: '',
                    category_gender_id: '',
                    supplier_id: '',
                    show: 1,
                    product_image: '',
                    product_active: 1,
                    product_new: 1,
                    product_description: '',
                },
                editorConfig: {}
            }
        },
        mounted() {
            this.fetchProducts();
            this.showDetailProduct();
        },
        methods: {
            fetchProducts(url_pro) {
                url_pro = url_pro || `${RESOURCE}/products`;
                axios.get(url_pro)
                    .then(res => {
                        this.products = res.data.products.data;
                        this.category = res.data.category;
                        this.gender = res.data.gender;
                        this.supplier = res.data.supplier;
                        this.pagination_pro = {
                            current_page: res.data.products.current_page,
                            last_page: res.data.products.last_page,
                            path_page: res.data.products.path,
                        };
                    })
                    .catch(err => console.log(err));
            },
            // CallBack Pagination
            clickCallback_pro(pageNum) {
                this.pagination_pro.current_page = Number(pageNum);
                this.fetchProducts(this.pagination_pro.path_page + '?page=' + this.pagination_pro.current_page);
            },

            setValPro(val_id, val_name, val_cat_name, val_cat_id, val_gender, val_show, val_new, val_description, val_supplier_name, val_supplier_id) {
                this.pro_id = val_id;
                this.pro_name = val_name;
                this.pro_cat_name = val_cat_name;
                this.pro_cat_id = val_cat_id;
                this.pro_gender = val_gender;
                this.pro_supplier_id = val_supplier_id;
                this.pro_supplier_name = val_supplier_name;
                // this.pro_show= val_show;
                this.pro_new = val_new;
                this.pro_description = val_description;


            },
            //Edit CATEGORY
            editCategory() {
                let id_cat = document.getElementById('cat_id').value;
                let name_cat = document.getElementById('cat_name').value;
                let item_cat = document.getElementById('cat_item').value;
                let gender_cat = document.getElementById('cat_gender').value;
                let show_cat = document.getElementById('cat_show').value;
                if (confirm('Bạn chắc chứ?')) {
                    axios.post(RESOURCE + '/category/edit/' + id_cat, {
                        val_1: name_cat,
                        val_2: item_cat,
                        val_3: gender_cat,
                        val_4: show_cat
                    })
                        .then(res => {
                            this.fetchCategories();
                            this.isShow = false
                        });
                }

            },
            showDetailProduct(index) {
                if (this.showDetail === true) {
                    var id_pro = this.products[index].product_id;
                }
                axios.get(RESOURCE + '/products/detail/' + id_pro)
                    .then(res => {
                        this.data_pro_detail = res.data;
                    })
            },
            createProduct() {
                axios.post(RESOURCE + '/products/add', {
                    name: this.newPro.name,
                    category: this.newPro.category_id,
                    gender: this.newPro.category_gender_id,
                    supplier: this.newPro.supplier_id,
                   description: this.newPro.product_description,
                    show:this.newPro.show,
                    active:this.newPro.product_active,
                    pro_new:this.newPro.product_new,
                })
                    .then(res => {
                        this.fetchProducts();
                        this.isAdd = false;
                    });
            }
        }
    }
</script>

<style lang="scss">
    .edit_pro {
        width: 100%;
        visibility: hidden;
        opacity: 0;
    }

    .form_edit_pro {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 999;
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        width: 100%;
    }

    .show_edit_pro {
        visibility: inherit;
        opacity: 1;
    }

    .detail_product {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        background: #fff;
        height: 100vh;
        z-index: 9999;
    }

    .active_showdetail_product {
        display: block;
    }

    .add_pro {
        display: none;
    }

    .active_add_pro {
        display: block;
    }
</style>
