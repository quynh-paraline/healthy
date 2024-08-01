<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    public $name;
    public $price;
    public $qty;
    public $description;
    public $category_id;
    public $thumbnail;
    public $categories;

    public function mount()
    {
        $this->categories = Category::all();
    }

    protected $rules = [
        'name' => 'required',
        'price' => 'required|numeric|min:0',
        'qty' => 'required|numeric|min:0',
        'thumbnail' => 'required|image|max:1024', // Example validation for image file
        'description' => 'required|string',
        'category_id' => 'required|exists:categories,id',
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
//        dd($thumbnailPath);
        Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'qty' => $this->qty,
            'thumbnail' => $thumbnailPath,
            'description' => $this->description,
            'category_id' => $this->category_id,
        ]);

        session()->flash('success', 'Product created successfully!');

        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.products.create');
    }

}
