<template>
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Thanks you</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/">Pages</a></li>
            <li class="breadcrumb-item active text-white">Thanks you</li>
        </ol>
    </div>

    <div class="thank">
        <h1 style="text-align: center;color: #2ca02c">Cảm ơn bạn đã mua hàng!</h1>

        <router-link to="/" class="btn btn-outline-primary">
        Home
        </router-link>
        <router-link :to="`/orders/detail/` + orderId" class="btn btn-outline-primary">
        Order Details
        </router-link>
        <router-link to="/orders/index" class="btn btn-outline-primary">
        Order History
        </router-link>
    </div>
</template>

<script>
export default {
    name: "Thankyou",
    data() {
        return {
            orderId: this.$route.params.id,
            order: null
        };
    },
    created() {
        this.fetchOrderDetails();
    },
    methods: {
        fetchOrderDetails() {
            axios.get(`/api/orders/detail/${this.orderId}`)
                .then(response => {
                    this.order = response.data;
                })
                .catch(error => {
                    console.error('Error fetching order details:', error);
                });
        }
    }
}
</script>

<style scoped>
.thank {
    text-align: center;
    margin-bottom: 50px;
    margin-top: 20px;
}

.thank a {
    margin: 10px;
}
</style>
