<div class="wrapper">
    <div class="row" style="margin-top: 50px">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Responsive Hover Table</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append">
                                @if($u->role == 1)
                                    <a href="{{url("/admin/categories/create")}}" class="btn btn-outline-primary">
                                        Create new category
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
                                    @if($u->role == 1)
                                        <a href="{{url("/admin/categories/edit",["category"=>$item->id])}}"
                                           class="btn btn-outline-info">Edit</a>
                                        <a onclick="return confirm('Are you confirm delete this category?')"
                                           wire:click.prevent="deleteCategory({{ $item->id }})"
                                           class="btn btn-outline-danger">Delete</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
