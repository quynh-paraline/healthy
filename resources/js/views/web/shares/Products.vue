<template>
    <div class="col-lg-9">
        <div class="row g-4 justify-content-center">
            <div v-for="item in products" :key="item.id" class="col-md-6 col-lg-6 col-xl-4">
                <div class="rounded position-relative fruite-item" style="min-width: 315px">
                    <div class="fruite-img">
                        <img :src="item.thumbnail" class="img-fluid w-100 rounded-top" style="min-height: 250px; max-height: 250px" :alt="item.name"/>
                    </div>
                    <div v-if="item.category" class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px">
                        {{ item.category.name }}
                    </div>
                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                        <h4>{{ item.name }}</h4>
                        <p>{{item.description.substring(0, 75   ) }}...</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">${{ item.price }}/kg</p>
                            <button v-if="item.qty > 0" class="btn border border-secondary rounded-pill px-3 text-primary">
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
            <div class="col-12">
                <div class="paginate">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item" v-for="page in paginationData.last_page" :key="page" :class="{ active: page === paginationData.current_page }">
                                <a class="page-link" href="#" @click.prevent="$emit('page-change', page)">{{ page }}</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        products: {
            type: Array,
            required: true
        },
        paginationData: {
            type: Object,
            required: true
        }
    },
    methods:{
        addToCart(product) {
            axios.post(`/api/carts/add/${product.id}`, { qty: 1 })
                .then(response => {
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error adding product to cart:', error);
                });
        }
    }
};
</script>

<style scoped>
.paginate .pagination {
    display: flex;
    justify-content: center;
}
</style>
