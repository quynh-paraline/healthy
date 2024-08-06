<template>
    <div>
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Cart</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/">Pages</a></li>
                <li class="breadcrumb-item active text-white">Cart</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Cart Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                        </thead>
                        <tbody v-for="product in products">
                        <tr>
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    <img :src="product.thumbnail" class="img-fluid me-5 rounded-circle"
                                         style="width: 80px; height: 80px;" alt="">
                                </div>
                            </th>
                            <td>
                                <p class="mb-0 mt-4">{{ product.name }}</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4">{{ product.price }}</p>
                            </td>
                            <td>
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                            <button @click="reduceToCart(product)" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0" min="1"
                                           :value="product.buy_qty">
                                    <div class="input-group-btn">
                                        <button @click="addToCart(product)"
                                                class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 mt-4">
                                    ${{ product.price * product.buy_qty }}
                                </p>
                            </td>
                            <td>
                                <button @click="cartRemove(product)" class="btn btn-md rounded-circle bg-light border mt-4">
                                        <i class="fa fa-times text-danger"></i>
                                </button>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0 me-4">Shipping</h5>
                                    <div class="">
                                        <p class="mb-0">Flat rate: $3.00</p>
                                    </div>
                                </div>
                                <br>
                                <p class="free_shipping" style="color: #4eb256">Free shipping for orders over $50.</p>
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">SubTotal</h5>
                                <p class="mb-0 pe-4">${{ total }}</p>
                            </div>
                            <a href="/checkouts/index">
                                <button
                                    class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                                    type="button">Proceed Checkout
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Cart',
    data() {
        return {
            products: [],
            total: 0,
        };
    },
    mounted() {
        this.fetchCartData();
    },
    methods: {
        fetchCartData() {
            axios.get('/api/carts/index')
                .then(response => {
                    this.products = response.data.products;
                    this.total = response.data.total;
                })
                .catch(error => {
                    console.error('Error fetching cart data:', error);
                });
        },
        addToCart(product) {
            axios.post(`/api/carts/add/${product.id}`)
                .then(response => {
                    this.fetchCartData();
                })
                .catch(error => {
                    console.error('Error adding product to cart:', error);
                });
        },
        cartRemove(product) {
            axios.post(`/api/carts/remove/${product.id}`)
                .then(response => {
                    this.fetchCartData()
                })
                .catch(error => {
                    console.error('Error adding product to remove:', error);
                });
        },
        reduceToCart(product) {
            axios.post(`/api/carts/reduce/${product.id}`)
                .then(response => {
                    this.fetchCartData()
                })
                .catch(error => {
                    console.error('Error adding product to reduce:', error);
                });
        }
    }
};
</script>

<style scoped>
/* Add your scoped styles here */
</style>
