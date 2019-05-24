<template>
    <div class="wrapper">

        <header-component></header-component>
        <!-- Left side column. contains the logo and sidebar -->

        <sidebar-component></sidebar-component>
        <!-- Content Wrapper. Contains page content -->
        <router-view></router-view>
        <!-- /.content-wrapper -->

        <footer-component></footer-component>
    </div>
</template>

<script>
    import Header from './layout/Header';
    import SideBar from './layout/SideBar';
    import Footer from './layout/Footer';

    export default {
        name: "LoginBackend",
        components: {
            'header-component': Header,
            'sidebar-component': SideBar,
            'footer-component': Footer,
        }
    }
</script>

<style scoped>

</style>
