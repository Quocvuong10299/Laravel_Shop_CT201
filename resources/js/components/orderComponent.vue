<template>
    <div class="main position-relative">
        <div style="height:400px;" class="container-fluid banner__component px-0 table-responsive">
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Mã HD</th>
                    <th scope="col">Tên Khách Hàng</th>
                    <th scope="col">Ngày Đặt</th>
                    <th scope="col">SDT</th>
                    <th scope="col">Tổng Tiền</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Hành động</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(orders, index) in order" :key="orders.order_id">
                    <!--<input id="ord_id" type="hidden" :value="orders.order_id">-->
                    <th scope="row">#{{orders.order_id}}</th>
                    <td>{{orders.order_user_name}}</td>
                    <td>{{orders.order_date}}</td>
                    <td>{{orders.order_phone}}</td>
                    <td>VND <strong>{{orders.order_total}}</strong></td>
                    <td>
                        <select @change="changeState($event, index)" v-model="orders.order_state" :class="(orders.order_state === 0) ? 'text-danger' :'text-success'" class="form-control form-control-sm">

                            <option value="0" class="text-danger">Chưa xác nhận</option>
                            <option value="1" class="text-success">Xác nhận</option>
                        </select>
                    </td>
                    <td>
                        <button @click.prevent="detail = true;seeDetail(index)" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="component d-flex justify-content-center mt-5">
            <!--pagination using ajax -->
            <paginate v-if="pagination_order.current_page > 0"
                      :pageCount="pagination_order.last_page"
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
                      :clickHandler="clickCallback_order">
            </paginate>
        </div>
        <div>
            <div v-if="detail" :class="{active_detail : detail}" class="position-absolute w-100 detail_order">
                <h5>Chi tiết đơn hàng</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-sm">
                        <thead>
                        <tr>
                            <!--<input type="hidden" disabled class="form-control" id="det_id" name="det_id" required :value="this.det_id">-->
                            <th scope="col">SP</th>
                            <th scope="col">SL</th>
                            <th scope="col">Màu</th>
                            <th scope="col">Size</th>
                            <th scope="col">SKU</th>
                            <th scope="col">giá gốc</th>
                            <th scope="col">% giảm</th>
                            <th scope="col">Giá giảm</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Ghi chú</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(detail, index) in data_detail" :key="index" class="tr_detail">
                            <td>{{detail.order_detail_name}}</td>
                            <td>{{detail.order_detail_quantity}}</td>
                            <td>{{detail.order_detail_color}}</td>
                            <td>{{detail.order_detail_size}}</td>
                            <td>{{detail.order_detail_sku}}</td>
                            <td>{{detail.order_detail_price}}</td>
                            <td>{{detail.order_detail_percent_sale}}</td>
                            <td>{{detail.order_detail_price_sale}}</td>
                            <td>{{detail.order_address}}</td>
                            <td>{{detail.order_note}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <button @click="detail = false" class="btn btn-warning mx-2">Back</button>
            </div>
        </div>
    </div>
</template>

<script>
    import Paginate from 'vuejs-paginate';
    import {RESOURCE} from '../api';
    export default {
        name: "order-component",
        components:{
            Paginate
        },
        data(){
            return{
                order:[],
                pagination_order:{},
                status_state:{
                    id:'',
                    status:''
                },
                detail:false,
                data_detail:[],
            }
        },
        mounted(){
            this.fetchOrder();
            this.seeDetail();
        },
        methods:{
            fetchOrder(urlBase) {
                urlBase = urlBase || `${RESOURCE}/orders`;
                axios.get(urlBase)
                    .then(res => {
                        this.order = res.data.data;
                        this.pagination_order = {
                            current_page: res.data.current_page,
                            last_page: res.data.last_page,
                            path_page: res.data.path,
                        };
                    })
                    .catch(err => console.log(err));
            },
            clickCallback_order(pageNum) {
                this.pagination_order.current_page = Number(pageNum);
                this.fetchOrder(this.pagination_order.path_page + '?page=' + this.pagination_order.current_page);
            },
            changeState(event,index){
                let val_state = event.target.value;
                let id_order = this.order[index].order_id;
                // console.log(id_order);
                axios.put(RESOURCE + '/orders/state-status/' + id_order, {val_state: val_state})
                    .then(res => {
                        this.fetchOrder();
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            seeDetail(index){
                if(this.detail === true){
                    var id_ord = this.order[index].order_id;
                }
                // console.log(id_ord);
                axios.get(RESOURCE + '/orders/detail/'+id_ord)
                    .then(res => {
                        this.data_detail = res.data;
                    })
            }
        },
        computed:{

        },

    }
</script>

<style lang="scss">
    .detail_order{
        top:0;
        left:0;
        background:#fff;
        height:100%;
        z-index:9999;
        display: none;
    }
    .active_detail{
        display:block;
    }
    .tr_detail{
        td{
            font-size:16px!important;
        }
    }
</style>
