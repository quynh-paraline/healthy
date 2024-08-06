<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $email;
    public $role;
    public $password;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'role' => 'required',
        'password' => 'required|string|min:8',
    ];

    protected $messages = [
        'required' => 'Vui lòng điền đầy đủ thông tin trước khi xác nhận!',
        'min' => 'Phải nhập tối thiểu :min ký tự!',
        'email' => 'Email không hợp lệ!',
        'unique' => 'Email này đã được sử dụng!',
        'confirmed' => 'Mật khẩu xác nhận không khớp!'
    ];

    public function store()
    {
        $this->validate();

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->role = $this->role;
        $user->password = Hash::make($this->password);
        $user->save();

        session()->flash('success', 'User created successfully!');

        return redirect()->route('admin.users.index');
    }

    public function render()
    {
        return view('livewire.users.create');
    }
}
