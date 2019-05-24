<template>
    <aside id="colorlib-aside" role="complementary" class="js-fullheight text-center">
        <h1 id="colorlib-logo">
            <a href="/">
                <span class="img" style="background-image: url(/img/frontend/dd.jpg);"></span>Lionel Vo
            </a>
        </h1>
        <nav id="colorlib-main-menu" role="navigation">
            <ul>
                <li :class="activeUrl === 'home' ? 'colorlib-active' : ''">
                    <a href="/">Home</a>
                </li>
                <li :class="activeUrl === 'collection' ? 'colorlib-active' : ''">
                    <a href="/collection">Collection</a>
                </li>
                <li :class="activeUrl === 'about' ? 'colorlib-active' : ''">
                    <a href="/about">About Me</a>
                </li>
                <li :class="activeUrl === 'services' ? 'colorlib-active' : ''">
                    <a href="/services">My Services</a>
                </li>
                <li :class="activeUrl === 'blog' ? 'colorlib-active' : ''">
                    <a href="blog">Blog</a>
                </li>
                <li :class="activeUrl === 'contact' ? 'colorlib-active' : ''">
                    <a href="contact">Contact</a>
                </li>
            </ul>
        </nav>

        <div class="colorlib-footer">
            <h3>Newsletter</h3>
            <div class="d-flex justify-content-center">
                <form action="#" class="colorlib-subscribe-form">
                    <div class="form-group d-flex">
                        <div class="icon">
                            <span class="icon-paper-plane"></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Enter Email Address">
                    </div>
                </form>
            </div>
        </div>
    </aside> <!-- END COLORLIB-ASIDE -->
</template>

<script>
    export default {
        name: "SideBar",
        data () {
            return {
                activeUrl: null,
            }
        },
        created: function () {
            this.activeUrl = this.$route.name;
        }
    }
</script>

<style scoped>

</style>