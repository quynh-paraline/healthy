<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $productId;
    public $name;
    public $price;
    public $qty;
    public $thumbnail;
    public $newThumbnail;
    public $description;
    public $category_id;
    public $categories;

    public function mount($id)
    {
        $product = Product::findOrFail($id);
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->qty = $product->qty;
        $this->thumbnail = $product->thumbnail;
        $this->description = $product->description;
        $this->category_id = $product->category_id;
        $this->categories = Category::all();
    }

    protected $rules = [
        'name' => 'required',
        'price' => 'required|numeric|min:0',
        'qty' => 'required|numeric|min:0',
        'newThumbnail' => 'nullable|image|max:1024', // Validation for new image file
        'description' => 'nullable|string',
        'category_id' => 'required|exists:categories,id',
    ];

    public function update()
    {
        $this->validate();

        $product = Product::find($this->productId);

        $thumbnailPath = $product->thumbnail;

        if ($this->newThumbnail) {
            if ($product->thumbnail && file_exists(public_path($product->thumbnail))) {
                unlink(public_path($product->thumbnail));
            }

            $fileName = time() . '_' . $this->newThumbnail->getClientOriginalName();
            $this->newThumbnail->storeAs('uploads', $fileName, 'public');
            $thumbnailPath = '/storage/uploads/' . $fileName;
        }

        $product->name = $this->name;
        $product->price = $this->price;
        $product->qty = $this->qty;
        $product->description = $this->description;
        $product->category_id = $this->category_id;
        $product->thumbnail = $thumbnailPath;
        $product->save();

        session()->flash('success', 'Product updated successfully!');

        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.products.edit',);
    }
}
