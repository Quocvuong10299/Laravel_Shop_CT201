<template>
    <div class="main position-relative">
        <div class="row w-100 mx-0">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-white px-0 mx-0 d-flex align-items-center justify-content-end">
                <input style="width: 300px;border:1px solid #ccc;" type="text" v-model="search_sku" placeholder="Tìm kiếm sku" class="form-control mr-2" />
                <button class="btn btn-success my-1 mr-2" @click="is_add_attr = true">Thêm mới</button>
            </div>
        </div>
        <div style="height:400px;" class="container-fluid banner__component px-0">
            <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Mã SP</th>
                        <th scope="col">Tên SP</th>
                        <th scope="col">Màu</th>
                        <th scope="col">Kích Thước</th>
                        <th scope="col">Số lượng tồn kho</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(attr, index) in filterSku" :key="index">
                        <th scope="row">{{attr.product_id}}</th>
                        <th scope="row">{{attr.product_name}}</th>
                        <td>
                            <div style="width: 20px; height: 20px" class="" :style="{'background-color': attr.color_value}"></div>
                        </td>
                        <td>{{attr.size_value}}</td>
                        <td>{{attr.quantity_current}}</td>
                        <td>{{attr.sku}}</td>
                        <td>
                            <!--<button class="btn btn-warning">Ẩn</button>-->
<!--                            <button @click="is_edit_attr = true; setValEdit(attr.product_id,attr.product_name,attr.size_value,attr.sku,attr.quantity_current,attr.color_name)" class="btn bg-warning" >Sửa</button>-->
                            <button class="btn bg-danger" @click="deleteAttr(attr.sku)">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="component d-flex justify-content-center mt-5">
            <!--pagination using ajax -->
            <paginate v-if="pagination_attr.current_page > 0"
                      :pageCount="pagination_attr.last_page"
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
                      :clickHandler="clickCallback_attr">
            </paginate>
        </div>
<!--        edit-->
<!--        <div class="show_cat" v-if="is_edit_attr" :class="{show_edit_active : is_edit_attr}">-->
<!--            <div class="form_add">-->
<!--                <h1>Edit The Attribute</h1>-->
<!--                <input type="hidden" disabled class="form-control" id="id_attr" name="id" required :value="this.attr_id">-->
<!--                <div class="form-group">-->
<!--                    <label for="sku">Mã SKU</label>-->
<!--                    <input id="sku" type="text" class="form-control" :value="this.attr_sku" placeholder="SKU" required />-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label for="qty">Số Lượng</label>-->
<!--                    <input id="qty" type="number" :value="this.attr_qty" class="form-control" placeholder="Số Lượng" required />-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label for="name">Sản Phẩm</label>-->
<!--                    <select id="name" class="form-control" size="5" name="item_add">-->
<!--                        <option disabled selected>{{this.attr_name}}</option>-->
<!--                        <option v-for="(pro_attrs, index) in pro_attr" :key="index" :value="pro_attrs.product_id">-->
<!--                            {{pro_attrs.product_name}}-->
<!--                        </option>-->
<!--                    </select>-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label for="size">Size</label>-->
<!--                    <select id="size" class="form-control" name="item_add">-->
<!--                        <option disabled selected>{{this.attr_size}}</option>-->
<!--                        <option v-for="(sizes, index) in size_attr" :key="index" :value="sizes.size_value">-->
<!--                            {{sizes.size_value}}-->
<!--                        </option>-->
<!--                    </select>-->
<!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <label for="color">Màu</label>-->
<!--                    <select id="color" class="form-control">-->
<!--                        <option disabled selected>{{this.attr_color}}</option>-->
<!--                        <option v-for="(colors, index) in color_attr" :key="index" :value="colors.color_value">-->
<!--                            {{colors.color_name}}-->
<!--                        </option>-->
<!--                    </select>-->
<!--                </div>-->
<!--                <button type="submit" class="btn bg-light" @click="is_edit_attr = false">Hủy</button>-->
<!--                <button type="submit" class="btn btn-success" @click="editAttr()">Lưu</button>-->
<!--            </div>-->
<!--            <div class="overlay_form"></div>-->
<!--        </div>-->
<!--        add-->
        <div class="show_cat" v-if="is_add_attr" :class="{show_attr_active : is_add_attr}">
            <div class="form_add">
                <h1>Add The Attribute</h1>
                <input type="hidden" disabled class="form-control" id="" name="" required />
                <div class="form-group">
                    <label for="sku">Mã SKU</label>
                    <input v-model="new_attr.sku"  type="text" class="form-control" id="" placeholder="SKU" required />
                </div>
                <div class="form-group">
                    <label for="sku">Số Lượng</label>
                    <input v-model="new_attr.qty"  type="number" class="form-control" id="" placeholder="Số Lượng" required />
                </div>
                <div class="form-group">
                        <label>Sản Phẩm</label>
                        <select v-model="new_attr.pro_id" class="form-control" size="5" name="item_add">
                            <option disabled selected> Chọn SP </option>
                            <option v-for="(pro_attrs, index) in pro_attr" :key="index" :value="pro_attrs.product_id">
                                {{pro_attrs.product_name}}
                            </option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="item_add">Size</label>
                    <select v-model="new_attr.size" class="form-control" id="item_add" name="item_add">
                        <option disabled selected> Chọn Size </option>
                        <option v-for="(sizes, index) in size_attr" :key="index" :value="sizes.size_value">
                            {{sizes.size_value}}
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="item_add">Màu</label>
                    <select v-model="new_attr.color" class="form-control" id="item_add" name="item_add">
                        <option disabled selected> Chọn Màu </option>
                        <option v-for="(colors, index) in color_attr" :key="index" :value="colors.color_value">
                            {{colors.color_name}}
                        </option>
                    </select>
                </div>
                <button type="submit" class="btn bg-light" @click="is_add_attr = false">Hủy</button>
                <button type="submit" class="btn btn-success" @click="addAttribute()">Tạo</button>
            </div>
            <div class="overlay_form"></div>
        </div>
    </div>
</template>

<script>
    import {RESOURCE} from "../api";
    import Paginate from "vuejs-paginate";

    export default {
        name: "productAttributeComponent",
        components:{
            Paginate
        },
        data(){
            return{
                attribute:[],
                pagination_attr:{},
                is_add_attr:false,
                is_edit_attr:false,
                color_attr:[],
                size_attr:[],
                pro_attr:[],
                search_sku:'',
                new_attr:{
                    pro_id:'',
                    sku:'',
                    qty:'',
                    size:'',
                    color:'',
                    coupon:1
                }
            }
        },
        mounted(){
            this.fetchAttribute();
            this.fetchSizeAttr();
            this.fetchColorAttr();
            this.fetchProAttr();
        },
        methods:{
            fetchAttribute(url_Attr){
                url_Attr = url_Attr || `${RESOURCE}/products/product_attributes`;
                axios.get(url_Attr)
                    .then(res => {
                        this.attribute = res.data.data;
                        this.pagination_attr = {
                            current_page: res.data.current_page,
                            last_page: res.data.last_page,
                            path_page: res.data.path,
                        };
                    })
                    .catch(err => console.log(err));
            },
            //CallBack Pagination
            clickCallback_attr(pageNum) {
                this.pagination_attr.current_page = Number(pageNum);
                this.fetchAttribute(this.pagination_attr.path_page + '?page=' + this.pagination_attr.current_page);
            },
            fetchSizeAttr(){
                axios.get(RESOURCE + '/sizes')
                    .then(res => {
                        this.size_attr = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })

            },
            fetchColorAttr(){
                axios.get(RESOURCE + '/colors')
                    .then(res => {
                        this.color_attr = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })

            },
            fetchProAttr(){
                axios.get(RESOURCE + '/attribute/all-pro')
                    .then(res => {
                        this.pro_attr = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })

            },
            addAttribute(){
                axios.post(RESOURCE + '/attribute/addAttr', {color: this.new_attr.color, size:this.new_attr.size,sku:this.new_attr.sku,qty:this.new_attr.qty,pro_id:this.new_attr.pro_id,coupon:this.new_attr.coupon})
                    .then(res => {
                        this.fetchAttribute();
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            deleteAttr(sku){
                if(confirm('Bạn chắc chứ?')){
                    axios.delete(`${RESOURCE}/attr/delete/${sku}`)
                        .then(res => {
                            this.fetchAttribute();
                            // console.log(res.data.message);
                        })
                }
            }
            // setValEdit(val_id, val_name, val_size, val_sku, val_qty, val_color) {
            //     this.attr_id = val_id;
            //     this.attr_name = val_name;
            //     this.attr_size = val_size;
            //     this.attr_sku = val_sku;
            //     this.attr_qty= val_qty;
            //     this.attr_color= val_color;
            // },
            // editAttr(){
            //     let id_attr = document.getElementById('id_attr').value;
            //     let sku = document.getElementById('sku').value;
            //     let qty = document.getElementById('qty').value;
            //     let name = document.getElementById('name').value;
            //     let size = document.getElementById('size').value;
            //     let color = document.getElementById('color').value;
            //     axios.post(RESOURCE + '/attribute/edit/' + id_attr, {attr_1: sku, attr_2: qty,attr_3: name,attr_4: size,attr_5:color })
            //         .then(res => {
            //             console.log(onkeyup(sku));
            //             this.fetchCategories();
            //             this.isShow=false
            //         });
            //
            // },
        },
        computed:{
            filterSku(){
                if(this.search_sku){
                    return this.attribute
                        .filter((item) => {
                            return item.sku.toLowerCase().indexOf(this.search_sku.toLowerCase()) > -1;
                        })
                }else{
                    return this.attribute;
                }

            }
        }
    }
</script>

<style lang="scss">
    .overlay_form{
        width: 100%;
        height: 100vh;
        background: rgba(0,0,0,0.3);
        position:absolute;
        z-index:99;
        top:0;
        left:0;
    }
    .form_edit,.form_add{
        position:absolute;
        top:50%;
        left:50%;
        transform: translate(-50%,-50%);
        z-index: 999;
        background: #fff;
        padding:20px;
        border-radius: 5px;
        /*height: 300px;*/
        /*overflow-y: auto;*/
    }
    .edit_cat, .show_cat{
        visibility: hidden;
        opacity: 0;
    }
    .show_edit{
        visibility: visible;
        opacity: 1;
    }
    .show_attr_active, .show_edit_active{
        visibility: visible;
        opacity: 1;
    }
</style>
