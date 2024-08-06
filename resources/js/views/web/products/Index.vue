<template>
    <div>
        <!-- ... -->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <h1 class="mb-4">Fresh fruits shop</h1>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            <div class="col-xl-3">
                                <div class="input-group w-100 mx-auto d-flex">
                                    <form @submit.prevent="searchProducts" style="display: flex">
                                        <input v-model="searchTerm" type="search" class="form-control p-3" placeholder="Search products...">
                                        <button style="float: right; height: 57.6px;width:75px;margin-left: 5px" type="submit" class="input-group-text p-3 btn btn-primary">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <!-- Sidebar component -->
                                <Sidebar/>
                            </div>

                            <Products :products="products" :paginationData="paginationData" @page-change="fetchProducts" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ... -->
    </div>
</template>

<script>
import axios from 'axios';
import Sidebar from "@/views/web/shares/Sidebar.vue";
import Products from "@/views/web/shares/Index.vue";

export default {
    components: {
        Products,
        Sidebar,
    },
    data() {
        return {
            searchTerm: '',
            products: [], // Initialize products as an empty array
            paginationData: {
                total: 0,
                last_page: 1,
                current_page: 1
            }
        };
    },
    methods: {
        searchProducts() {
            this.fetchProducts();
        },
        fetchProducts(page = 1) {
            axios.get(`/api/products/index?content=${this.searchTerm}`)
                .then(response => {
                    this.products = response.data.data; // Assuming response.data.data is your products array
                    this.paginationData = {
                        total: response.data.total,
                        last_page: response.data.last_page,
                        current_page: response.data.current_page
                    };
                })
                .catch(error => {
                    console.error('Error fetching products:', error);
                    this.products = []; // Set products to empty array or handle error state
                });
        },
    },
    mounted() {
        this.fetchProducts();
    },
};
</script>

<style scoped>
/* Add your scoped styles here */
</style>
