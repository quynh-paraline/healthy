<?php

namespace App\Livewire\Administrators;

use App\Models\Administrators;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Edit extends Component
{
    public $administratorId;
    public $name;
    public $email;
    public $role;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'role' => 'required',
        'password' => 'nullable|string|min:8|confirmed'
    ];

    protected $messages = [
        "required" => "Vui lòng điền đầy đủ thông tin trước khi xác nhận!",
        "min" => "Phải nhập tối thiểu :min",
        "max" => "Nhập giá trị không vượt quá :max",
    ];

    public function mount($id)
    {
        $administrator = Administrators::findOrFail($id);
        $this->administratorId = $administrator->id;
        $this->name = $administrator->name;
        $this->email = $administrator->email;
        $this->role = $administrator->role;
    }

    public function update()
    {
        $this->validate();

        $administrator = Administrators::find($this->administratorId);
        $administrator->name = $this->name;
        $administrator->role = $this->role;

        if (!empty($this->password)) {
            $administrator->password = Hash::make($this->password);
        }

        $administrator->save();

        session()->flash('success', 'Administrator updated successfully!');

        return redirect()->route("admin.administrators.index");
    }

    public function render()
    {
        return view('livewire.administrators.edit');
    }
}
