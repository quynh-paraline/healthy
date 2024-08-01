<template>
    <Head/>
    <Navbar/>
    <router-view></router-view>
    <banner/>
    <Footer/>
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">

                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a
                    class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
        class="fa fa-arrow-up"></i></a>
    <Script/>
</template>

<script>
import Head from "@/views/web/layouts/parts/Head.vue";
import Navbar from "@/views/web/layouts/parts/Navbar.vue";
import Banner from "@/views/web/layouts/parts/Banner.vue";
import Footer from "@/views/web/layouts/parts/Footer.vue";
import Script from "@/views/web/layouts/parts/Script.vue";

export default {
    name: "Layout",
    components: {Script, Footer, Banner, Navbar, Head}
}
</script>

<style scoped>

</style>
