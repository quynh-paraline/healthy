<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $content = '';
    public $categories;
    public $user;
    public $u;

    public function mount()
    {
        $this->categories = Category::all();
        $this->user = Auth::user();
        $this->u = auth()->user();
    }

    public function searchProducts()
    {
        if ($this->content) {
            return Product::orderBy('id', 'desc')
                ->where('name', 'like', '%' . $this->content . '%')
                ->paginate(10);
        } else {
            return Product::orderBy('id', 'desc')->paginate(10);
        }
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        session()->flash('danger', 'Product deleted successfully!');
        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        $products = $this->searchProducts();
        return view('livewire.products.index', ['products' => $products]);
    }
}
