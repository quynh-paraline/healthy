@extends("web.layouts.main")
@section("main")
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

        <a href="{{url("/")}}" class="btn btn-outline-primary">
            Home
        </a>
        <a href="{{url("/invoice",[$order->id])}}" class="btn btn-outline-primary">
            Order Details
        </a>
        <a href="{{url("/ordered")}}" class="btn btn-outline-primary">
            Order History
        </a>
    </div>
@endsection
<style>
    .thank {
        text-align: center;
        margin-bottom: 50px;
        margin-top: 20px;
    }

    .thank a {
        margin: 10px;
    }
</style>
