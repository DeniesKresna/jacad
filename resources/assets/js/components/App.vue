<template>
    <div>
        <header-component></header-component>
        <div class="container-fluid">
            <div class="row row-offcanvas row-offcanvas-left">
                <sidebar-component></sidebar-component>
                <div class="col-xs-12 col-sm-9 content">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a href="javascript:void(0);" class="toggle-sidebar">
                                    <span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span>
                                </a> Panel Title
                            </h3>
                        </div>
                        <div class="panel-body">
                            <loading 
                                :active.sync="isLoading" 
                                :is-full-page="true">
                            </loading>
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import HeaderComponent from './partial/HeaderComponent.vue';
    import SidebarComponent from './partial/SidebarComponent.vue';
    import FooterComponent from './partial/FooterComponent.vue';
    import Loading from 'vue-loading-overlay';

    import 'vue-loading-overlay/dist/vue-loading.css';

    export default{
        components:{
            HeaderComponent, 
            SidebarComponent, 
            FooterComponent, 
            Loading
        },
        data() {
            return{
                
            }
        },
        computed: {
            isLoading(){
                return this.$store.getters.isLoading;
            }
        }
    }
</script>