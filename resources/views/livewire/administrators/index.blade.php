@php
    $roles = include(config_path('administrators.php'));
@endphp
<div class="wrapper">
    <div class="row" style="margin-top: 50px">
        <div class="col-12">
            <div class="card">
                <div class="form-filter" style="width:1200px;margin-left: 300px">
                    <form wire:submit.prevent="filter"
                          style="margin-top: 30px;margin-bottom: 20px;border: 1px solid #d7d4d4;padding: 10px">
                        @csrf
                        <select wire:model="role" style="border-radius: 5px;height: 45px;margin-left: 30px">
                            <option value="" {{ app('request')->input('role') == '0' ? 'selected' : '' }}>All admin</option>
                            @foreach ($roles as $key => $role)
                                <option value="{{$key}}" {{ app('request')->input('role') == $key ? 'selected' : '' }}>{{$role}}</option>
                            @endforeach
                        </select>
                        <input style="border-radius: 5px;height: 45px;margin-left: 30px" type="text"
                               value="{{app("request")->input('email')}}"
                               wire:model="email" placeholder="Email">

                        <button style="height: 45px;margin-left: 30px;width: 150px" type="submit"
                                class="btn btn-success">Filter
                        </button>
                        <a href="{{route("admin.administrators.index")}}" class="btn btn-primary"
                           style="width: 100px;height: 45px;padding-top: 10px;margin-left: 25px">RESET</a>
                    </form>

                    <div class="card-tools" style="float: right">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append">
                                @if($u->role == 1)
                                    <a href="{{url("/admin/administrators/create")}}" class="btn btn-outline-primary">
                                        Create new admin
                                    </a>
                                @endif
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
                        @foreach($administrators as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                @if (isset($roles[$item->role]))
                                    <td>{{ $roles[$item->role] }}</td>
                                @endif
                                @if($u->role == 1)
                                    <td>
                                        <a href="{{url("/admin/administrators/edit",["administrator"=>$item->id])}}"
                                           class="btn btn-outline-info">Edit</a>
                                        @if($u->id != $item->id && $item->role !== 1)
                                            <a onclick="return confirm('Are you comfirm delete this administrator?')"
                                               wire:click.prevent="deleteAdministrator({{ $item->id }})"
                                               class="btn btn-outline-danger">Delete</a>
                                        @endif
                                    </td>
                                @else
                                    <td>
                                        @if($u->id == $item->id)
                                            <a onclick="return confirm('Are you comfirm delete this administrator?')"
                                               wire:click.prevent="deleteAdministrator({{ $item->id }})"
                                               class="btn btn-outline-danger">Delete</a>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
