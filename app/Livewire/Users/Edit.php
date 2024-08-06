<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Edit extends Component
{
    public $userId;
    public $name;
    public $role;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|min:3',
        'role' => 'required',
        'password' => 'nullable|string|min:8|confirmed',
    ];

    protected $messages = [
        'required' => 'Vui lòng điền đầy đủ thông tin trước khi xác nhận!',
        'min' => 'Phải nhập tối thiểu :min ký tự!',
        'confirmed' => 'Mật khẩu xác nhận không khớp!',
    ];

    public function mount($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->role = $user->role;
    }

    public function update()
    {
        $this->validate();

        $user = User::find($this->userId);

        if ($user->role != 5) {
            $user->name = $this->name;
            $user->role = $this->role;
            if (!empty($this->password)) {
                $user->password = Hash::make($this->password);
            }
            $user->save();

            session()->flash('success', 'You updated successfully!');
        } else {
            session()->flash('danger', "Don't change role of admin!");
        }

        return redirect()->route('admin.users.index');
    }

    public function render()
    {
        return view('livewire.users.edit');
    }
}
