<?php

namespace App\Livewire\Administrators;

use App\Models\Administrators;
use App\Models\Product;
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
        $query = Administrators::query();
        if ($this->email) {
            $query->where('email', 'like', "%{$this->email}%");
        }

        if ($this->role !== null && $this->role !== "") {
            $query->where('role', $this->role);
        }
        return $query->get();
    }

    public function deleteAdministrator($id)
    {
        $administrator = Administrators::findOrFail($id);
        $administrator->delete();

        session()->flash('danger', 'Product deleted successfully!');
        return redirect()->route('admin.administrators.index');
    }

    public function render()
    {
        $administrators = $this->filter();
        return view('livewire.administrators.index', ['administrators' => $administrators]);
    }
}
