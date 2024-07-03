@extends("admin.layouts.layout")
@section("main")

    <div class="wrapper">
        <div class="row" style="margin-top: 50px">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="form-search" style="margin-left: 300px;margin-bottom: -26px">
                            <form action="/admin/products/index" method="get">
                                <input style="width: 300px;height: 50px" type="text" name="content" value="{{app("request")->input('content')}}"
                                       placeholder="Search by keyword">

                                <button class="btn btn-success" style="width: 100px;height: 50px;margin-top: -5px"
                                        type="submit">Search
                                </button>
                                <a href="{{route("admin.products.index")}}" class="btn btn-primary" style="width: 100px;height: 50px;padding-top: 10px;margin-top: -5px">RESET</a>
                            </form>
                        </div>


                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;margin-top: 30px">
                                <div class="input-group-append">
                                    @if($u->role == 1)
                                    <a href="{{url("/admin/products/create")}}" class="btn btn-outline-primary">
                                        Create new product
                                    </a>
                                    @endif
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
                                        @if($u->role == 1)
                                        <a href="{{url("/admin/products/edit",["product"=>$item->id])}}"
                                           class="btn btn-outline-info">Edit</a>
                                        <a onclick="return confirm('Are you comfirm delete this product?')"
                                           href="{{url("/admin/products/delete",["product"=>$item->id])}}"
                                           class="btn btn-outline-danger">Delete</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="col-12">
                            <div class="paginate" style="margin-left: 450px">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            {!! $products->links("pagination::bootstrap-4") !!}
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
