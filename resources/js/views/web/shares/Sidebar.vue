<template>
    <br>
    <div class="row g-4">
        <div class="col-lg-12">
            <div class="mb-3">
                <h4>Categories</h4>
                <ul v-for="category in categories" class="list-unstyled fruite-categorie">
                    <li>
                        <div class="d-flex justify-content-between fruite-name">
                            <RouterLink :to="'/products/filter/'+ category.id"><i
                                class="fas fa-apple-alt me-2"></i>{{category.name}}</RouterLink>
                            <span v-if="category.products">({{category.products.count()}})</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="position-relative">
                <img src="/img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                    <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Sidebar",
    data() {
        return {
            categories: [],
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
                })
                .catch(error => console.error('Error fetching data:', error));
        }
    }
}
</script>

<style scoped>

</style>
