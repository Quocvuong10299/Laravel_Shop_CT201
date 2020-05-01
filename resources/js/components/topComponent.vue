<template>
    <div class="right__menu">
        <div class="container px-5 top__menu">
            <ul class="nav top__menu--ul">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa fa-bell-o" aria-hidden="true"></i>
                        <span>1</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fa fa-commenting-o" aria-hidden="true"></i>
                        <span>10</span>
                    </a>
                </li>
                <div class="">
                    <div class="sub_ ml-3">
                        <form method="get" action="/api/users/logout">
                            <button class="btn btn-warning" @click="btnLogout()">Thoát</button>
                        </form>
                            <!--<a style="color:#000" href="/api/users/logout">Thoát</a>-->

                    </div>
                </div>
            </ul>
        </div>
    </div>
</template>

<script>
    import {RESOURCE} from '../api';
    export default {
        name: "top-component",
        data(){
            return{
                logout:'',
            }
        },
        methods:{
            btnLogout(){
                axios.get(RESOURCE + '/users/logout')
                    .then(res => {
                        this.logout = res.data;
                        // if(res.status === 200) {
                        //     this.$router.push({ path : '/admin' });
                        // }
                    });
            }
        }
    }
</script>

<style scoped>

</style>