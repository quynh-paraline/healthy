@extends("admins.layouts.layout")
@section("main")

    <div class="wrapper">
        <div class="row" style="margin-top: 50px">
            <div class="col-12">
                <div class="card">
                    <div class="form-filter" style="width:1200px;margin-left: 300px">
                        <form action="/admin/orders/filter" method="get"
                              style="margin-top: 30px;margin-bottom: 20px;border: 1px solid #d7d4d4;padding: 10px">
                            @csrf
                            <label style="margin-left: 50px" for="startDate">Start date</label>
                            <input id="startDate" style="border-radius: 5px;height: 45px" type="date" name="startDate"
                                   placeholder="Start Date">
                            <label style="margin-left: 30px" for="endDate">End date</label>
                            <input id="endDate" style="border-radius: 5px;height: 45px" type="date" name="endDate"
                                   placeholder="End Date">
                            <select name="status" style="border-radius: 5px;height: 45px;margin-left: 50px">
                                <option value="">Please chose status</option>
                                <option value="0">Waiting</option>
                                <option value="1">Confirmed</option>
                                <option value="2">Shipping</option>
                                <option value="3">Completed</option>
                                <option value="4">Cancelled</option>
                                <option value="5">Returns</option>
                                <option value="6">Confirm Returns</option>
                                <option value="7">Completed Returns</option>
                            </select>
                            <input style="border-radius: 5px;height: 45px;margin-left: 50px" type="text"
                                   name="phone_number" placeholder="Phone number">

                            <button style="height: 45px;margin-left: 50px;width: 150px" type="submit"
                                    class="btn btn-success">Filter
                            </button>
                        </form>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="width:1200px;margin-left: 300px">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full name</th>
                                <th>Email</th>
                                <th>Phone number</th>
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
                                    <td>{{$item->full_name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phone_number}}</td>
                                    <td>${{$item->expense}}</td>
                                    <td>
                                        @switch($item->status)
                                            @case(0) <span class="btn btn-warning">Waiting...</span> @break
                                            @case(1) <span class="btn btn-primary">Confirmed</span> @break
                                            @case(2) <span class="btn btn-warning">Shipping</span> @break
                                            @case(3) <span class="btn btn-secondary">Compeleted</span> @break
                                            @case(4) <span class="btn btn-warning">Cancelled</span> @break
                                            @case(5) <span class="btn btn-warning">Returns</span> @break
                                            @case(6) <span class="btn btn-warning">Confirm returns</span> @break
                                            @case(6) <span class="btn btn-warning">Completed returns</span> @break
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
                                        <a href="{{url("/admin/orders/detail",["order"=>$item->id])}}"
                                           class="btn btn-outline-info">View</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
