@extends("admins.layouts.layout")
@section("main")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Invoice</h1>
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
                        <div class="callout callout-info">
                            <h5><i class="fas fa-info"></i> Note:</h5>
                            This page has been enhanced for printing. Click the print button at the bottom of the
                            invoice to test.
                        </div>


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
                                    <b>Payment Due:</b> {{$order->created_at}}<br>
                                    @if($order->is_paid==0)
                                        <b>Paided: </b> Not yet!
                                    @else
                                        <b>Paided: </b> Already!
                                    @endif
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
                                            <th>Description</th>
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
                                    <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                            class="fas fa-print"></i> Print</a>
                                    <button type="button" class="btn btn-success float-right"><i
                                            class="far fa-credit-card"></i> Submit
                                        Payment
                                    </button>
                                    <button type="button" class="btn btn-primary float-right"
                                            style="margin-right: 5px;">
                                        <i class="fas fa-download"></i> Generate PDF
                                    </button>
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
