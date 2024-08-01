<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $thumbnail;

    protected $rules = [
        'name' => 'required',
        'thumbnail' => 'required|image|max:1024',
    ];

    public function store()
    {
        $this->validate();

        $thumbnailPath = null;
        if ($this->thumbnail) {
            $fileName = time() . '.' . $this->thumbnail->getClientOriginalExtension();
            $this->thumbnail->storeAs('uploads', $fileName, 'public');
            $thumbnailPath = '/storage/uploads/' . $fileName;
        }

        Category::create([
            'name' => $this->name,
            'thumbnail' => $thumbnailPath,
        ]);

        session()->flash('success', 'Category created successfully!');

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.categories.create');
    }
}
