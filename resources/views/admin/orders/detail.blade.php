@extends("admin.layouts.layout")
@section("main")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Invoice :
                            @switch($order->status)
                                @case(0) <span class="text text-warning">Waiting...</span> @break
                                @case(1) <span class="text text-primary">Confirmed</span> @break
                                @case(2) <span class="text text-red">Shipping</span>  @break
                                @case(3) <span class="text text-success">Compeleted</span>  @break
                                @case(4) <span class="text text-secondary">Returns</span> @break
                                @case(5) <span class="text text-primary">Confirm returns</span> @break
                                @case(6) <span class="text text-success">Completed returns</span>  @break
                                @case(7) <span class="text text-danger">Cancelled</span> @break
                                @case(8) <span class="text text-danger">Returns Failed</span> @break
                            @endswitch
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <!-- info row -->
                            <div class="row invoice-info">

                                <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                        <strong>{{$order->full_name}}</strong><br>
                                        {{$order->address}}<br>
                                        {{$order->city}}<br>
                                        Phone: {{$order->phone_number}}<br>
                                        Email: {{$order->email}}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Invoice #{{$order->id}}</b><br>
                                    <br>
                                    <b>Order ID:</b> {{$order->id}}<br>
                                    <b>Order at:</b> {{$order->created_at}}<br>
                                    @if($order->is_paid==0)
                                        <b>Paided: </b> <span class="text-danger">Not yet!</span>
                                    @else
                                        <b>Paided: </b> <span class="text-success">Already!</span>
                                    @endif
                                    <br>
                                    <b>Order status:</b>

                                    @switch($order->status)
                                        @case(0) <span class="text text-warning">Waiting...</span> @break
                                        @case(1) <span class="text text-primary">Confirmed</span> @break
                                        @case(2) <span class="text text-red">Shipping</span>  @break
                                        @case(3) <span class="text text-success">Compeleted</span>  @break
                                        @case(4) <span class="text text-secondary">Returns</span> @break
                                        @case(5) <span class="text text-primary">Confirm returns</span> @break
                                        @case(6) <span class="text text-success">Completed returns</span>  @break
                                        @case(7) <span class="text text-danger">Cancelled</span> @break
                                        @case(8) <span class="text text-danger">Returns Failed</span> @break
                                    @endswitch

                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Thumbnail</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->products as $item)
                                            <tr>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->pivot->buy_qty}}</td>
                                                <td><img src="{{$item->thumbnail}}" class="img-thumbnail" width="100"/>
                                                </td>
                                                <td>${{$item->price}}</td>
                                                <td>${{$item->pivot->expense}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-6">
                                    <h3 class="">Payment Methods: {{$order->payment_method}}</h3>
                                </div>
                                <!-- /.col -->
                                <div class="col-6">
                                    <p class="lead">Amount Due 2/22/2014</p>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                @if($order->expense >= 53)
                                                    <td>${{$order->expense}}</td>
                                                @else
                                                    <td>${{$order->expense - 3}}</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <th>Shipping:</th>
                                                <td>$3.00</td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td>${{$order->expense}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="#" rel="noopener" target="_blank" class="btn btn-default"><i
                                            class="fas fa-print"></i>Printf</a>

                                    @switch($order->status)
                                        @case(0)
                                            <a type="button" onclick="return confirm('Are you sure comfirm this order?')"
                                               href="{{url("/admin/orders/status",["order"=>$order->id])}}" class="btn btn-success float-right"
                                            style="margin-right: 30px"> Confirm order
                                            </a>
                                            <a onclick="return confirm('Are you sure comfirm cancel this order?')"
                                               type="button" href="{{url("/admin/orders/cancel",["order"=>$order->id])}}" class="btn btn-danger float-right"
                                               style="margin-right: 35px;">
                                                 Cancel order
                                            </a>

                                            @break
                                        @case(1)
                                            <a type="button" onclick="return confirm('Are you sure comfirm ship this order?')"
                                               href="{{url("/admin/orders/status",["order"=>$order->id])}}" class="btn btn-success float-right"
                                               style="margin-right: 30px"> Ship order
                                            </a>
                                            @break
                                        @case(2)
                                            <a type="button" onclick="return confirm('Are you sure comfirm compeleted this order?')"
                                               href="{{url("/admin/orders/status",["order"=>$order->id])}}" class="btn btn-success float-right"
                                               style="margin-right: 30px"> Compeleted
                                            </a>
                                            @break
                                        @case(3)
                                            <a class="text-black-50 btn btn-success float-right"
                                               style="margin-right: 30px"> Compeleted...
                                            </a>
                                            @break
                                        @case(4)
                                            <a type="button" onclick="return confirm('Are you sure comfirm returns this order?')"
                                               href="{{url("/admin/orders/status",["order"=>$order->id])}}" class="btn btn-success float-right"
                                               style="margin-right: 30px"> Confirm returns
                                            </a>
                                            <a type="button" onclick="return confirm('Are you sure comfirm returns this order?')"
                                               href="{{url("/admin/orders/cancelReturns",["order"=>$order->id])}}" class="btn btn-danger float-right"
                                               style="margin-right: 30px"> Cancel returns
                                            </a>
                                            @break
                                        @case(5)
                                            <a type="button" onclick="return confirm('Are you sure comfirm completed returns this order?')"
                                               href="{{url("/admin/orders/status",["order"=>$order->id])}}" class="btn btn-success float-right"
                                               style="margin-right: 30px"> Completed returns
                                            </a>
                                            @break
                                    @endswitch
                                    <a type="button" href="/admin/orders/index" class="btn btn-secondary float-right"
                                       style="margin-right: 35px;"> <i class="fa fa-arrow-left"></i>
                                        Back to orders
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
