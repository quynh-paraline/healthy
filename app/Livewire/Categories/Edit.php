<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $categoryId;
    public $name;
    public $thumbnail;
    public $newThumbnail;

    public function mount($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->thumbnail = $category->thumbnail;
    }

    protected $rules = [
        'name' => 'required',
        'newThumbnail' => 'nullable|image|max:1024',
    ];

    public function update()
    {
        $this->validate();

        $category = Category::find($this->categoryId);

        $thumbnailPath = $category->thumbnail;
        if ($this->newThumbnail) {
            if ($category->thumbnail && file_exists(public_path($category->thumbnail))) {
                unlink(public_path($category->thumbnail));
            }

            $fileName = time() . '_' . $this->newThumbnail->getClientOriginalName();
            $this->newThumbnail->storeAs('uploads', $fileName, 'public');
            $thumbnailPath = '/storage/uploads/' . $fileName;
        }

        $category->name = $this->name;
        $category->thumbnail = $thumbnailPath;
        $category->save();

        // Flash success message
        session()->flash('success', 'Category updated successfully!');

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('livewire.categories.edit');
    }
}
