<template>
    <Slide/>
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Our Organic Products</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item">
                            <a href="#tab-1">
                                <p class="text-dark" style="width: 130px;">All Products</p>
                            </a>
                        </li>
                        <li v-for="category in categories" :key="category.id" class="nav-item">
                            <a :href="'/filter/' + category.id">
                                <p class="text-dark" style="width: 130px;">{{ category.name }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                <div v-for="product in products" :key="product.id" class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item" style="min-width: 315px">
                                        <div class="fruite-img">
                                            <img :src="product.thumbnail" class="img-fluid w-100 rounded-top"
                                                 style="min-height: 250px;max-height: 250px" :alt="product.name">
                                        </div>
                                        <div v-if="product.category" class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                             style="top: 10px; left: 10px;background-color: red">
                                            {{ product.category.name }}
                                        </div>
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4>{{ product.name }}</h4>
                                            <p>{{ product.description.substring(0, 50) }}...</p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <p class="text-dark fs-5 fw-bold mb-0">${{ product.price }}/kg</p>
                                                <button v-if="product.qty > 0" @click="addToCart(product)"
                                                   class="btn border border-secondary rounded-pill px-3 text-primary">
                                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                                </button>
                                                <button v-else
                                                        style="background-color: #bebfc0"
                                                        class="btn rounded-pill px-3">
                                                    <i class="fa fa-shopping-bag me-2" style="color: #606162"></i> Add to cart
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Slide from "@/views/web/layouts/parts/Slide.vue";

export default {
    name: "Index",
    components: {Slide},
    data() {
        return {
            categories: [],
            products: [],
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            // Gọi API để lấy dữ liệu
            fetch('/api/home/index')
                .then(response => response.json())
                .then(data => {
                    this.categories = data.categories;
                    this.products = data.products.data; // Lưu ý: Dữ liệu products phải phù hợp với cấu trúc của Laravel pagination
                })
                .catch(error => console.error('Error fetching data:', error));
        },
        addToCart(product) {
            axios.post(`/api/carts/add/${product.id}`, { qty: 1 })
                .then(response => {
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error adding product to cart:', error);
                });
        },
    }
};
</script>

<style scoped>
/* CSS scoped to this component */
</style>
