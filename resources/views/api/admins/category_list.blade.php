@extends("api.admins.layouts.layout")
@section("main")
    <div class="wrapper">
        <div class="row" style="margin-top: 50px">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Responsive Hover Table</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <div class="input-group-append">
                                    <a href="{{url("/admin/categories/create")}}" class="btn btn-outline-primary">
                                        Create new category
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
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td><img src="{{$item->thumbnail}}" class="img-thumbnail" width="100"/></td>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        <a href="{{url("/admin/categories/edit",["category"=>$item->id])}}"
                                           class="btn btn-outline-info">Edit</a>
                                        <a onclick="return confirm('Are you confirm delete this category?')"
                                           href="{{url("/admin/category/delete",["category"=>$item->id])}}"
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
