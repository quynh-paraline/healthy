<?php

namespace App\Livewire\Administrators;

use App\Models\Administrators;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $email;
    public $password;
    public $role;

    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|unique:administrators,email',
        'password' => 'required|string|min:8',
        'role' => 'required'
    ];

    protected $messages = [
        'required' => 'Vui lòng điền đầy đủ thông tin trước khi xác nhận!',
        'min' => 'Phải nhập tối thiểu :min',
        'max' => 'Nhập giá trị không vượt quá :max',
        'unique' => 'Email này đã tồn tại!',
    ];

    public function store()
    {
        $this->validate();

        Administrators::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        session()->flash('success', 'Administrator created successfully!');

        return redirect()->route("admin.administrators.index");
    }

    public function render()
    {
        return view('livewire.administrators.create');
    }
}
