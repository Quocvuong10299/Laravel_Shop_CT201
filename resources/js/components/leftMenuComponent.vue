<template>
    <div class="vertical-nav bg-dark" id="sidebar">
        <div class="py-4 px-3 mb-4 bg-dark">
            <div class="media-body">
                <h4 class="font-weight-white text-muted mb-0">King's Admin</h4>
                <p class="font-weight-grey text-muted mb-0">since 2020</p>
            </div>
        </div>
        <ul class="nav flex-column bg-dark mb-0">
            <li class="nav-item add_active">
                <router-link :to="{name: 'dashboardComponent'}" class="nav-link font-italic">
                <i class="fa fa-tachometer mr-3 fa-fw" aria-hidden="true"></i>Dashboard
                </router-link>
            </li>
            <li class="nav-item add_active">
                <router-link :to="{name: 'chartComponent'}" class="nav-link font-italic">
                    <i class="fa fa-pie-chart mr-3 fa-fw" aria-hidden="true"></i>Chart
                </router-link>
                <!--<a class="nav-link" href="#"><i class="fa fa-pie-chart mr-3 fa-fw" aria-hidden="true"></i> Chart</a>-->
            </li>
            <li class="nav-item add_active">
                <router-link :to="{name: 'categoryComponent'}" class="nav-link font-italic">
                    <i class="fa fa-tags mr-3 fa-fw" aria-hidden="true"></i> Category
                </router-link>
                <!--<a class="nav-link" href="#"><i class="fa fa-tags" aria-hidden="true"></i> Category</a>-->
            </li>
            <li class="nav-item add_active">
                <router-link :to="{name: 'productsComponent'}" class="nav-link font-italic">
                    <i class="fa fa-archive mr-3 fa-fw" aria-hidden="true"></i> Products
                </router-link>
                <!--<a class="nav-link" href="products.html"><i class="fa fa-archive" aria-hidden="true"></i> Products</a>-->
            </li>
            <li class="nav-item add_active position-relative">
                <router-link :to="{name: 'orderComponent'}" class="nav-link font-italic">
                    <i class="fa fa-list-ul mr-3 fa-fw" aria-hidden="true"></i> Orders
                    <div class="notifi_number">
                        <p class="number_order">{{count_order}}</p>
                    </div>
                </router-link>
                <!--<a class="nav-link" href="#"><i class="fa fa-list-ul mr-3 fa-fw" aria-hidden="true"></i> Orders</a>-->
            </li>
            <li class="nav-item add_active position-relative">
                <a class="nav-link" href="#"><i class="fa fa-money mr-3 fa-fw" aria-hidden="true"></i> Discount  <i class="fa fa-angle-left" aria-hidden="true"></i></a>
                <ul class="sub__menu flex-column">
                    <router-link :to="{name: 'dateComponent'}" class="nav-link font-italic">
                        Date Sale
                    </router-link>
                </ul>
            </li>
            <li class="nav-item add_active position-relative">
                <a class="nav-link" href="#"><i class="fa fa-info-circle mr-3 fa-fw" aria-hidden="true"></i> Attributes <i class="fa fa-angle-left" aria-hidden="true"></i></a>
                <ul class="sub__menu flex-column">
                    <router-link :to="{name: 'colorComponent'}" class="nav-link font-italic">
                        Color
                    </router-link>
                    <router-link :to="{name: 'sizeComponent'}" class="nav-link font-italic">
                        Size
                    </router-link>
                </ul>
            </li>
            <li class="nav-item add_active">
                <router-link :to="{name: 'commentComponent'}" class="nav-link font-italic">
                    <i class="fa fa-comment mr-3 fa-fw" aria-hidden="true"></i> Comment
                </router-link>
                <!--<a class="nav-link" href="comment.html"><i class="fa fa-comment" aria-hidden="true"></i> Comments</a>-->
            </li>
            <li class="nav-item add_active">
                <router-link :to="{name: 'slideComponent'}" class="nav-link font-italic">
                    <i class="fa fa-slideshare mr-3 fa-fw" aria-hidden="true"></i>Slide
                </router-link>
                <!--<a class="nav-link" href="#"><i class="fa fa-slideshare mr-3 fa-fw" aria-hidden="true"></i> Slide</a>-->
            </li>
            <li class="nav-item add_active">
                <router-link :to="{name: 'usersComponent'}" class="nav-link font-italic">
                    <i class="fa fa-user mr-3 fa-fw" aria-hidden="true"></i>Users
                </router-link>
                <!--<a class="nav-link" href="./users.html"><i class="fa fa-user" aria-hidden="true"></i> Users</a>-->
            </li>
            <li class="nav-item add_active">
                <router-link :to="{name: 'supplierComponent'}" class="nav-link font-italic">
                    <i class="fa fa-handshake-o" aria-hidden="true"></i>    Supplier
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>
    import {RESOURCE} from '../api';
    export default {
        name: "left-menu-component",
        data(){
            return{
                count_order:[],
            }
        },
        mounted(){
            this.count_noti();
        },
        // computed:{
        //   countNotify(){
        //       return this.count_order.length;
        //   }
        // },
        methods:{
            count_noti(){
                axios.get(RESOURCE + '/orders/count-length')
                    .then(res => {
                        this.count_order = res.data.length;
                    })
            }
        }
    }
</script>

<style lang="scss">
    .notifi_number{
        position: absolute;
        top:25%;
        right:10px;
        .number_order{
            width: 20px;
            height: 20px;
            border-radius: 100%;
            background: red;
            text-align: center;
            color:#fff;
        }
    }
</style>