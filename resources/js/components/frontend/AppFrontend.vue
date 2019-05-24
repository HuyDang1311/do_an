<template>
    <div id="colorlib-page">
        <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
        <sidebar-component></sidebar-component>
        <div id="colorlib-main">
            <router-view></router-view>
            <footer-component></footer-component>
        </div><!-- END COLORLIB-MAIN -->
    </div><!-- END COLORLIB-PAGE -->
</template>

<script>
    import SideBar from './layout/SideBar';
    import Footer from './layout/Footer';

    export default {
        name: "AppFrontend",
        components: {
            'footer-component': Footer,
            'sidebar-component': SideBar,
        }
    }
</script>

<style scoped>

</style>