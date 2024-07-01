<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use function Laravel\Prompts\error;

class UsersController extends Controller
{
    public function index()
    {
        $request = request();
        $email = $request->get("email");
        $role = $request->get("role");
        if (!empty($email)) {
            $users = User::where("email", "like", "%$email%")->get();
        } elseif ($role !== null && $role !== "") {
            $users = User::where("role", $role)->get();
        } else {
            $users = User::all();
        }
        return view("admin.users.index", ["users" => $users]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view("admin.users.edit", ["user" => $user]);
    }

    public function update($id)
    {
        $request = request();
        $request->validate([
            "name" => "required|min:3",
            "role" => "required",
            'password' => 'nullable|string|min:6|confirmed'
        ], [
            "required" => "Vui lòng điền đầy đủ thông tin trước khi xác nhận!",
            "min"=>"phải nhập tối thiểu : min !"
        ]);

        $user = User::find($id);
        if ($user->role != 5) {
            $user->name = request("name");
            $user->role = request("role");
            if ($request->filled('password')) {
                $user->password = bcrypt($request->input('password'));
            }
            $user->save();

            $request->session()->flash('success', 'You updated successfully!');
        } else {
            $request->session()->flash('danger', "Don't change role of admin!");
        }

        return redirect()->to(route("admin.users.index"));
    }

    public function create(){
        return view("admin.users.create");
    }

    public function store()
    {
        $request = request();
        $request->validate([
            "name" => "required|min:3",
            "email" => "required|email|unique:users,email",
            "role" => "required",
            'password' => 'required|string|min:6'
        ], [
            "required" => "Vui lòng điền đầy đủ thông tin trước khi xác nhận!",
            "min" => "Phải nhập tối thiểu :min ký tự!",
            "email" => "Email không hợp lệ!",
            "unique" => "Email này đã được sử dụng!",
            "confirmed" => "Mật khẩu xác nhận không khớp!"
        ]);

        $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->role = $request->input("role");
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $request->session()->flash('success', 'User created successfully!');

        return redirect()->route("admin.users.index");
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        session()->flash('danger', 'Member deleted successfully!');
        return redirect()->to(route("admin.users.index"));
    }
}
