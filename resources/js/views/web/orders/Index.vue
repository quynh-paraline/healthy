<template>
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">All invoice</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/">Pages</a></li>
            <li class="breadcrumb-item active text-white">All invoice</li>
        </ol>
    </div>

    <div class="card-body table-responsive p-0" style="width:1200px;margin : auto;margin-top: 30px">
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th>ID</th>
                <th>Expense</th>
                <th>Status</th>
                <th>Paid</th>
                <th>Payment method</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="order in orders">
                <td>{{order.id}}</td>
                <td>${{order.expense}}</td>
                <td>
                    <span v-if="order.status === 0" class="btn btn-warning">Waiting...</span>
                    <span v-else-if="order.status === 1" class="btn btn-primary">Confirmed</span>
                    <span v-else-if="order.status === 2" class="btn btn-secondary">Shipping</span>
                    <span v-else-if="order.status === 3" class="btn btn-success">Compeleted</span>
                    <span v-else-if="order.status === 4" class="btn btn-warning">Returns</span>
                    <span v-else-if="order.status === 5" class="btn btn-primary">Confirm returns</span>
                    <span v-else-if="order.status === 6" class="btn btn-success">Completed returns</span>
                    <span v-else-if="order.status === 7" class="btn btn-danger">Cancelled</span>
                    <span v-else-if="order.status === 8" class="btn btn-danger">Returns Failed</span>
                    <span v-else class="btn btn-danger">Status unknown</span>
                </td>
                <td>
                    <span v-if="order.is_paid = 0" class="text-danger">Not paid</span>
                    <span v-else class="text-success">Paid</span>
                </td>
                <td>{{order.payment_method}}</td>
                <td>
                    <router-link :to="`/orders/detail/${order.id}`"
                                 class="btn btn-outline-info">View
                    </router-link>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "Index",
    data() {
        return {
            orders: [],
            loading: false,
            error: null
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.loading = true;
            axios.get('/api/orders/index')
                .then(response => {
                    this.orders = response.data.orders;
                    this.loading = false;
                })
                .catch(error => {
                    this.error = 'Error fetching data: ' + error.message;
                    this.loading = false;
                });
        }
    }
}
</script>

<style scoped>

</style>
