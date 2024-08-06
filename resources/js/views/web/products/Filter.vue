<template>
        <!-- Page Header -->
        <div class="container-fluid page-header py-5" v-if="category">
            <h1 class="text-center text-white display-6">{{ category.name }}</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/">Pages</a></li>
                <li class="breadcrumb-item active text-white">{{ category.name }}</li>
            </ol>
        </div>

        <!-- Index Section -->
        <div class="container-fluid fruite py-5" v-if="products.length > 0">
            <div class="container py-5">
                <h1 class="mb-4">Fresh fruits shop</h1>
                <div class="row g-4">
                    <div class="col-lg-3">
                        <Sidebar />
                    </div>
                        <Products :products="products" :paginationData="paginationData" @page-change="fetchData" />
                </div>
            </div>
        </div>

        <!-- No Index Found -->
        <div v-else-if="category" class="container py-5 text-center">
            <h2 style="color: #898a8c">
                No products found for the category: "{{ category.name }}"
            </h2>
        </div>

        <!-- Loading -->
        <div v-else class="container py-5 text-center">
            <h2 style="color: #898a8c">
                Loading...
            </h2>
        </div>
</template>

<script>
import axios from 'axios';
import Products from "@/views/web/shares/Index.vue";
import Sidebar from "@/views/web/shares/Sidebar.vue";

export default {
    name: "Filter",
    components: {
        Sidebar,
        Products
    },
    data() {
        return {
            category: null,
            products: [],
            paginationData: {
                total: 0,
                last_page: 1,
                current_page: 1
            },
            loading: true
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData(page = 1) {
            const categoryId = this.$route.params.id;
            axios.get(`/api/products/filter/${categoryId}`)
                .then(response => {
                    this.category = response.data.category;
                    this.products = response.data.products.data;
                    this.paginationData = {
                        total: response.data.products.total,
                        last_page: response.data.products.last_page,
                        current_page: response.data.products.current_page
                    };
                    this.loading = false;
                })
                .catch(error => {
                    console.error(error);
                    this.loading = false;
                });
        }
    }
}
</script>

<style scoped>
</style>
