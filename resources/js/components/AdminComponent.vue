<template>
    <div class="wrapper bg-light">
        <left-menu-component/>
        <div class="page-content position-relative" id="content">
            <top-component/>
            <!-- Toggle button -->
                <button id="sidebarCollapse" type="button" class="d-block d-lg-none btn px-4 mb-4">
                    <i class="fa fa-bars mr-2"></i>
                </button>
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
<style lang="scss">
    .fa-pencil-square-o,.fa-trash-o{
        color:#fff;
    }
</style>
