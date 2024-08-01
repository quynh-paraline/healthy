<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;

class Index extends Component
{
    public $categories;
    public $u;

    public function mount()
    {
        $this->categories = Category::all();
        $this->u = auth()->user();
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        session()->flash('danger', 'Category deleted successfully!');
        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.categories.index');
    }
}
