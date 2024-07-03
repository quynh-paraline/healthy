@extends("web.layouts.main")
@section("main")
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing details</h1>
            <form action="/placeOrder" method="post">
                @csrf
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="form-group-checkout"
                             style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; justify-content: center;">
                            <div class="form-item">
                                <label class="form-label my-3">Full Name<sup>*</sup></label>
                                <input type="text" name="full_name" class="form-control" placeholder="Full name ">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Email Address<sup>*</sup></label>
                                <input type="email" name="email" class="form-control" placeholder="Your email">
                            </div>
                        </div>
                        <div class="form-group-checkout"
                             style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; justify-content: center;">
                            <div class="form-item">
                                <label class="form-label my-3">Home address <sup>*</sup></label>
                                <input type="text" name="address" class="form-control" placeholder="Delivery address">
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">City<sup>*</sup></label>
                                <input type="text" name="city" class="form-control">
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Phone number<sup>*</sup></label>
                            <input type="text" name="phone_number" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <hr>
                            <table class="table" style="margin-top: -50px">
                                <tbody>
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark py-4">Shipping :</p>
                                    </td>
                                    @if($total < 53)
                                        <td class="py-5">
                                            <label style="margin-top: 25px;color: #e50606;margin-left: 220px"
                                                   class="form-check-label" for="Shipping-1">$3</label>
                                        </td>
                                    @else
                                        <td class="py-5">
                                            <label style="margin-top: 25px;color: #81c408;margin-left: 220px"
                                                   class="form-check-label" for="Shipping-1">Free Shipping</label>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">

                                                <p class="mb-0 text-dark" style="margin-left: -150px">${{$total}}</p>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="Delivery-1"
                                           name="payment_method" value="COD">
                                    <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="Paypal-1"
                                           name="payment_method" value="PAYPAL">
                                    <label class="form-check-label" for="Paypal-1">Paypal</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="submit"
                                    class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order
                            </button>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-5" style="margin-top: -250px;width: 750px">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Products</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $item)
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center mt-2">
                                                <img src="{{$item->thumbnail}}" class="img-fluid rounded-circle"
                                                     style="width: 90px; height: 90px;" alt="">
                                            </div>
                                        </th>
                                        <td class="py-5">{{$item->name}}</td>
                                        <td class="py-5">{{$item->price}}</td>
                                        <td class="py-5">{{$item->buy_qty}}</td>
                                        <td class="py-5">${{$item->price * $item->buy_qty}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
