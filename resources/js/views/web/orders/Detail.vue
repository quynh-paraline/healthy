<template>
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Invoice</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="/web">Home</a></li>
            <li class="breadcrumb-item"><a href="/">Pages</a></li>
            <li class="breadcrumb-item active text-white">Invoice</li>
        </ol>
    </div>

    <div class="container mt-5 mb-5">

        <div class="row d-flex justify-content-center">

            <div class="col-md-8">

                <div class="card">
                    <div class="text-left logo p-2 px-5">
                        <img src="https://fbcd.co/images/products/75ff08c4edd77315ff923c0a8ac6c413_resize.png"
                             width="150px">
                        <h2 style="float: right;margin-top: 25px;margin-right: 200px;color: #28a745;font-weight: bold">
                            HEALTHY FOODS</h2>
                    </div>

                    <div class="invoice p-5">

                        <h5>Your order is
                            <span v-if="order.status === 0" class="btn btn-warning">Waiting...!</span>
                            <span v-else-if="order.status === 1" class="btn btn-primary">Confirmed !</span>
                            <span v-else-if="order.status === 2" class="btn btn-secondary">Shipping !</span>
                            <span v-else-if="order.status === 3" class="btn btn-success">Completed !</span>
                            <span v-else-if="order.status === 4" class="btn btn-warning">Returns !</span>
                            <span v-else-if="order.status === 5" class="btn btn-primary">Confirm returns !</span>
                            <span v-else-if="order.status === 6" class="btn btn-success">Completed returns !</span>
                            <span v-else-if="order.status === 7" class="btn btn-danger">Cancelled !</span>
                            <span v-else-if="order.status === 8" class="btn btn-danger">Returns Failed !</span>
                            <span v-else class="btn btn-danger">Status unknown !</span>

                        </h5>
                        <span
                            class="font-weight-bold d-block mt-4">Hello, {{order.full_name}}</span>
                        <span>You order has been confirmed and will be shipped in next two days!</span>

                        <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">

                            <table class="table table-borderless">

                                <tbody>
                                <tr>
                                    <td>
                                        <div class="py-2">
                                            <span class="d-block text-muted">Order Date</span>
                                            <span>{{order.created_at}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="py-2">
                                            <span class="d-block text-muted">Order ID</span>
                                            <span>{{order.id}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="py-2">
                                            <span
                                                class="d-block text-muted">Payment method :{{order.payment_method}}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="py-2">
                                            <span class="d-block text-muted">Shipping Address</span>
                                            <span>{{order.address}},{{order.city}}</span>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="product border-bottom table-responsive">
                            <table v-for="item in order.products" :key="item.id" class="table table-borderless">
                                <tbody>
                                <tr>
                                    <td style="width: 5px">
                                        <img :src="item.thumbnail" width="90">
                                    </td>
                                    <td>
                                        <span class="font-weight-bold">Name: {{item.name}}</span>
                                        <div class="product-qty">
                                            <span class="d-block">Quantity: {{item.pivot.buy_qty}}</span>
                                            <span class="font-weight-bold">Price: ${{item.price}}</span>
                                        </div>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                                <div class="cart-total mb-3" style="height: auto">
                                    <h3>Cart Totals</h3>
                                    <div v-if="order.expense >= 50">
                                    <p class="d-flex">
                                        <span>Delivery :</span>
                                        <span style="margin-left: 5px">$0.00</span>
                                    </p>
                                    <hr>
                                    <p class="d-flex total-price">
                                        <span>Total :</span>
                                        <span style="margin-left: 5px">${{order.expense}}</span>
                                    </p>
                                    <p class="d-flex total-price" style="text-align: center;font-size: 35px">
                                        <b v-if="order.is_paid || order.status === 3" style="color: #2ca02c"><span class="text-success">Paid</span></b>

                                        <b v-else style="color: #e50606"><span class="text-danger">unPaid</span></b>
                                    </p>
                                    </div>
                                    <div v-else>
                                    <p class="d-flex">
                                        <span>Delivery :</span>
                                        <span style="margin-left: 5px"> $3.00</span>
                                    </p>


                                    <hr>
                                    <p class="d-flex total-price">
                                        <span>Total : </span>
                                        <span style="margin-left: 5px">${{order.expense}}</span>

                                    </p>
                                    <p class="d-flex total-price" style="text-align: center">
                                    <b v-if="order.is_paid || order.status === 3" style="color: #2ca02c"><span class="text-success">Paid</span></b>
                                    <b v-else style="color: #e50606"><span class="text-danger">unPaid</span></b>
                                    </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <router-link v-if="order.status === 0" style="margin-top: -50px" :to="`/orders/cancel/${order.id}`"
                                     class="btn btn-danger">Cancel this order !</router-link>
                        <router-link v-else-if="order.status === 3 && order.updated_at >= timestamp " style="margin-top: -50px" :to="`/orders/returns/${order.id}`"
                                     class="btn btn-primary">Returns this order !</router-link>
                        <div v-else></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import dayjs from 'dayjs'
export default {
    name: "Detail",
    data() {
        return {
            order: {},
            error: null,
            timestamp: ""
        };
    },
    mounted() {
        this.fetchData();
        this.getNowMinusOneDay();
    },
    methods: {
        fetchData() {
            const orderId = this.$route.params.id;
            axios.get(`/api/orders/detail/${orderId}`)
                .then(response => {
                    this.order = response.data.order;
                })
                .catch(error => {
                    this.error = 'Error fetching data: ' + error.message;
                });
        },
        getNowMinusOneDay() {
            const nowMinusOneDay = dayjs().subtract(1, 'day').format('YYYY-MM-DD HH:mm:ss');
            this.timestamp = nowMinusOneDay;
        }
    }
}
</script>

<style scoped>

</style>
