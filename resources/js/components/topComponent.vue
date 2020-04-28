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
                            <a style="color:#000" href="/api/users/logout">Thoát</a>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "top-component",
    }
</script>

<style scoped>

</style>