@extends("admins.layouts.layout")
@section("main")

    <div class="wrapper">
        <div class="row" style="margin-top: 50px">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="form-search" style="margin-left: 300px;margin-bottom: -26px">
                            <form action="/admin/products/search" method="get">
                                <input style="width: 300px;height: 50px" type="text" name="content"
                                       placeholder="Search by keyword">

                                <button class="btn btn-success" style="width: 100px;height: 50px;margin-top: -5px"
                                        type="submit">Search
                                </button>
                            </form>
                        </div>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <div class="input-group-append">
                                    <a href="{{url("/admin/products/create")}}" class="btn btn-outline-primary">
                                        Create new product
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="width:1200px;margin-left: 300px">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Thumbnail</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td><img src="{{$item->thumbnail}}" class="img-thumbnail"
                                             style="max-width: 100px;min-width:100px;max-height: 75px;min-height: 75px"/>
                                    </td>
                                    <td>{{$item->name}}</td>
                                    <td>${{$item->price}}</td>
                                    <td>{{$item->qty}}</td>
                                    <td>{{$item->Category->name}}</td>
                                    <td>
                                        <a href="{{url("/admin/products/edit",["product"=>$item->id])}}"
                                           class="btn btn-outline-info">Edit</a>
                                        <a onclick="return confirm('Are you comfirm delete this product?')"
                                           href="{{url("/admin/product/delete",["product"=>$item->id])}}"
                                           class="btn btn-outline-danger">Delete</a>
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
