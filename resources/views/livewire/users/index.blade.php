<div class="wrapper">
    <div class="row" style="margin-top: 50px">
        <div class="col-12">
            <div class="card">
                <div class="form-filter" style="width:1200px;margin-left: 300px">
                    <form wire:submit.prevent="filter"
                          style="margin-top: 30px;margin-bottom: 20px;border: 1px solid #d7d4d4;padding: 10px">
                        <select wire:model="role" style="border-radius: 5px;height: 45px;margin-left: 30px" >
                            <option value="">All users</option>
                            <option value="0" {{ app('request')->input('role') == '0' ? 'selected' : '' }}>Client</option>
                            <option value="1" {{ app('request')->input('role') == '1' ? 'selected' : '' }}>Orders Management</option>
                            <option value="2" {{ app('request')->input('role') == '2' ? 'selected' : '' }}>Products Management</option>
                            <option value="5" {{ app('request')->input('role') == '5' ? 'selected' : '' }}>Returns</option>
                        </select>
                        <input style="border-radius: 5px;height: 45px;margin-left: 30px" type="text" value="{{app("request")->input('email')}}"
                               wire:model="email" placeholder="Email">

                        <button style="height: 45px;margin-left: 30px;width: 150px" type="submit"
                                class="btn btn-success">Filter
                        </button>
                        <a href="{{route("admin.users.index")}}" class="btn btn-primary" style="width: 100px;height: 45px;padding-top: 10px;margin-left: 25px">RESET</a>
                    </form>

                    <div class="card-tools" style="float: right">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append">
                                <a href="{{url("/admin/users/create")}}" class="btn btn-outline-primary">
                                    Create new member
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body table-responsive p-0" style="width:1200px;margin-left: 300px">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                @switch($item->role)
                                    @case(0)<td class="text-danger">Clients</td> @break
                                    @case(1)<td class="text-success">Orders Management</td> @break
                                    @case(2)<td class="text-warning">Products Management</td> @break
                                    @case(5)<td class="text-primary">Admin</td> @break
                                @endswitch
                                <td>
                                    <a href="{{url("/admin/users/edit",["user"=>$item->id])}}"
                                       class="btn btn-outline-info">Edit</a>
                                    <a onclick="return confirm('Are you comfirm delete this member?')"
                                       wire:click.prevent="deleteUser({{ $item->id }})"
                                       class="btn btn-outline-danger">Delete</a>
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
