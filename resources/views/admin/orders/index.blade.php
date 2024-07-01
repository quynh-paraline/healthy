@extends("admin.layouts.layout")
@section("main")

    <div class="wrapper">
        <div class="row" style="margin-top: 50px">
            <div class="col-12">
                <div class="card">
                    <div class="form-filter" style="width:1200px;margin-left: 300px">
                        <form action="/admin/orders/filter" method="get"
                              style="margin-top: 30px;margin-bottom: 20px;border: 1px solid #d7d4d4;padding: 10px">
                            @csrf
                            <label style="margin-left: 10px" for="startDate">Start date</label>
                            <input id="startDate" style="border-radius: 5px;height: 45px" type="date" name="startDate"  value="{{app("request")->input('startDate')}}"
                                   placeholder="Start Date">
                            <label style="margin-left: 30px" for="endDate">End date</label>
                            <input id="endDate" style="border-radius: 5px;height: 45px" type="date" name="endDate"  value="{{app("request")->input('endDate')}}"
                                   placeholder="End Date">
                            <select name="status" style="border-radius: 5px;height: 45px;margin-left: 30px" >
                                <option value="">All status</option>
                                <option value="0" {{ app('request')->input('status') == '0' ? 'selected' : '' }}>Waiting</option>
                                <option value="1" {{ app('request')->input('status') == '1' ? 'selected' : '' }}>Confirmed</option>
                                <option value="2" {{ app('request')->input('status') == '2' ? 'selected' : '' }}>Shipping</option>
                                <option value="3" {{ app('request')->input('status') == '3' ? 'selected' : '' }}>Completed</option>
                                <option value="4" {{ app('request')->input('status') == '4' ? 'selected' : '' }}>Returns</option>
                                <option value="5" {{ app('request')->input('status') == '5' ? 'selected' : '' }}>Confirm Returns</option>
                                <option value="6" {{ app('request')->input('status') == '6' ? 'selected' : '' }}>Completed Returns</option>
                                <option value="7" {{ app('request')->input('status') == '7' ? 'selected' : '' }}>Cancelled</option>
                                <option value="8" {{ app('request')->input('status') == '8' ? 'selected' : '' }}>Return failed</option>
                            </select>
                            <input style="border-radius: 5px;height: 45px;margin-left: 30px" type="text" value="{{app("request")->input('phone_number')}}"
                                   name="phone_number" placeholder="Phone number">

                            <button style="height: 45px;margin-left: 30px;width: 150px" type="submit"
                                    class="btn btn-success">Filter
                            </button>
                            <a href="{{route("admin.orders.index")}}" class="btn btn-primary" style="width: 100px;height: 45px;padding-top: 10px;margin-left: 25px">RESET</a>
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
                                <th>Total</th>
                                <th>Status</th>
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
                                            @case(2) <span class="btn btn-secondary">Shipping</span> @break
                                            @case(3) <span class="btn btn-success">Compeleted</span> @break
                                            @case(4) <span class="btn btn-warning">Returns</span> @break
                                            @case(5) <span class="btn btn-primary">Confirm returns</span> @break
                                            @case(6) <span class="btn btn-success">Completed returns</span> @break
                                            @case(7) <span class="btn btn-danger">Cancelled</span> @break
                                            @case(8) <span class="btn btn-danger">Return failed</span> @break
                                        @endswitch
                                    </td>

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
