<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrators;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends Controller
{
    public function index()
    {
        $request = request();
        $email = $request->get("email");
        $role = $request->get("role");
        $u = auth()->user();
        if (!empty($email)) {
            $administrators = Administrators::where("email", "like", "%$email%")->get();
        } elseif ($role !== null && $role !== "") {
            $administrators = Administrators::where("role", $role)->get();
        } else {
            $administrators = Administrators::all();
        }
        return view("admin.administrators.index", ["administrators" => $administrators,"u"=>$u]);
    }

    public function create()
    {
        return view("admin.administrators.create");
    }

    public function store()
    {
        $request = request();
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:administrators,email',
            'password' => 'required|string|min:8',
            'role' => 'required'
        ], [
            "required" => "Vui lòng điền đầy đủ thông tin trước khi xác nhận!",
            "min" => "Phải nhập tối thiểu :min",
            "max" => "Nhập giá trị không vượt quá :max",
            "unique" => "Email này đã tồn tại!",
        ]);

        Administrators::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ]);

        $request->session()->flash('success', 'Administrator created successfully!');

        return redirect()->route("admin.administrators.index");

    }

    public function edit($id)
    {
        $administrator = Administrators::find($id);
        return view("admin.administrators.edit", ["administrator" => $administrator]);
    }

    public function update($id)
    {
        $request = request();
        $administrator = Administrators::find($id);

        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'role' => 'required',
            'password' => 'nullable|string|min:6|confirmed'
        ], [
            "required" => "Vui lòng điền đầy đủ thông tin trước khi xác nhận!",
            "min" => "Phải nhập tối thiểu :min",
            "max" => "Nhập giá trị không vượt quá :max",
        ]);

        $administrator->name = $request->input('name');
        $administrator->role = $request->input('role');
        if ($request->filled('password')) {
            $administrator->password = bcrypt($request->input('password'));
        }

        $administrator->save();

        $request->session()->flash('success', 'Administrator updated successfully!');

        return redirect()->route("admin.administrators.index");
    }
    public function delete($id){
        $administrator = Administrators::find($id);
        $administrator->delete();
        session()->flash('danger', 'Management deleted successfully!');
        return redirect()->to(route("admin.administrators.index"));
    }
}
