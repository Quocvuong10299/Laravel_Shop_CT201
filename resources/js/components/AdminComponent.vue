<template>
    <div class="wrapper bg-light">
        <left-menu-component/>
        <div class="page-content position-relative" id="content">
            <top-component/>
            <!-- Toggle button -->
            <button id="sidebarCollapse" type="button" class="d-block d-lg-none btn btn-dark bg-dark rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold">Menu</small></button>
            <router-view/>
        </div>
    </div>
</template>

<script>
    import LeftMenuComponent from "./leftMenuComponent";
    import topComponent from "./topComponent";
    import dashboardComponent from "./dashboardComponent";
    export default {
        components: {
            topComponent,
            LeftMenuComponent,
            dashboardComponent
        }

    }
</script>
