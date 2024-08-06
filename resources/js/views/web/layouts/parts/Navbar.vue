<template>
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#"
                                                                                                     class="text-white">123
                        Street, New York</a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">Email@Example.com</a></small>
                </div>
                <div class="top-link pe-2">
                    <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                    <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                    <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <router-link to="/" class="navbar-brand"><h1 class="text-primary display-6">Healthy-foods</h1></router-link>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">

                        <router-link to="/" class="nav-item nav-link">Home</router-link>
                        <router-link to="/products/index" class="nav-item nav-link">Shop</router-link>
                        <router-link to="/carts/index" class="nav-item nav-link">Cart</router-link>
                        <router-link to="/orders/index" class="nav-item nav-link">Invoice</router-link>
                        <router-link to="/contact" class="nav-item nav-link">Contact</router-link>
                    </div>
                    <div class="d-flex m-3 me-0">
                        <router-link to="/carts/index" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x"></i>
                            <span
                                v-if="count>0"
                                class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                                style="top: -5px; left: 15px; height: 20px; min-width: 20px;">{{ count }}</span>
                            <span
                                v-else
                                class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                                style="top: -5px; left: 15px; height: 20px; min-width: 20px;">0</span>
                        </router-link>
                    </div>
                </div>
            </nav>
        </div>
    </div>

</template>

<script>
export default {
    name: "Navbar",
    data() {
        return {
            count: 0,
        };
    },
    created() {
        this.getCartCount();
    },
    methods:{
        getCartCount() {
            axios.get('/api/carts/count')
                .then(response => {
                    this.count = response.data.count;
                })
                .catch(error => {
                    console.error('Error fetching cart count:', error);
                });
        }
    }
}
</script>

<style scoped>

</style>
