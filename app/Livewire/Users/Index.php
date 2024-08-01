<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $email;
    public $role;
    public $u;

    public function mount()
    {
        $this->u = auth()->user();
    }

    public function filter()
    {
        $query = User::query();

        if ($this->email) {
            $query->where('email', 'like', "%{$this->email}%");
        }

        if ($this->role !== null && $this->role !== "") {
            $query->where('role', $this->role);
        }
        return $query->get();
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('danger', 'Product deleted successfully!');
        return redirect()->route('admin.users.index');
    }

    public function render()
    {
        $users = $this->filter();
        return view('livewire.users.index', ['users' => $users]);
    }
}
