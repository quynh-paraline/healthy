@extends("web.layouts.main")
@section("main")
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
            @foreach($orders as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>${{$item->expense}}</td>
                    <td>
                        @switch($item->status)
                            @case(0) <span class="btn btn-warning">Waiting...</span> @break
                            @case(1) <span class="btn btn-primary">Confirmed</span> @break
                            @case(2) <span class="btn btn-secondary">Shipping</span> @break
                            @case(3) <span class="btn btn-success">Compeleted</span> @break
                            @case(4) <span class="btn btn-warning">Returns</span> @break
                            @case(5) <span class="btn btn-primary">Confirm returns</span> @break
                            @case(6) <span class="btn btn-success">Completed returns</span> @break
                            @case(7) <span class="btn btn-danger">Cancelled</span> @break
                            @case(8) <span class="btn btn-danger">Returns Failed</span> @break

                        @endswitch
                    </td>
                    <td>
                        @if($item->is_paid==0)
                            <span class="text-danger">Not paid</span>
                        @else
                            <span class="text-success">Paid</span>
                        @endif
                    </td>
                    <td>{{$item->payment_method}}</td>
                    <td>
                        <a href="{{url("/orders/invoice",["order"=>$item->id])}}"
                           class="btn btn-outline-info">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
