@extends("admin.layouts.layout")

@php
$roles = include(config_path('administrators.php'));
@endphp

@section("main")
    <div class="row" style="margin-left: 250px">
        <form action="{{url("/admin/administrators/update",["administrators"=>$administrator->id])}}" method="post" enctype="multipart/form-data"
              style="margin-top: 50px">
            @csrf

            <div class="form-group">
                <div class="form-create">
                    <label for="exampleFormControlInput1">Name</label>
                    <input name="name" value="{{$administrator->name}}" type="text" class="form-control" placeholder="Full name" style="width: 250px">
                </div>

            </div>

            <div class="form-group">
                <div class="form-create_2" style="margin-top: -20px">
                    <label for="exampleFormControlInput1">Role</label>
                    <select name="role" class="form-control" style="width: 150px">
                        @foreach ($roles as $key => $role)
                        <option value="{{$key}}">{{$role}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-create">
                <label for="exampleFormControlInput1">New Password</label>
                <input name="password" type="password" class="form-control" placeholder="Leave blank if to keep current password" style="width: 300px">
            </div>
            <div class="form-create">
                <label for="exampleFormControlInput1">Confirm Password</label>
                <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm new password" style="width: 300px">
            </div>

            <div class="form-group">
                <button type="submit" style="margin-top: 30px" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
<style>
    form {
        width: 450px;
        margin: auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: #bfc0c0 solid 1px;
        padding-top: 30px;
        padding-bottom: 20px;
        border-radius: 10px;
    }
    .form-group {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .form-create, .form-create_2 {
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .form-create label, .form-create_2 label {
        margin-bottom: 5px;
    }

    .form-create input, .form-create_2 select {
        width: 100%;
        max-width: 300px;
    }

    .form-group button {
        width: 200px;
    }
</style>
