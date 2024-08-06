<?php

namespace App\Livewire\Orders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $categories;
    public $products;
    public $startDate;
    public $endDate;
    public $status;
    public $phone_number;

    public function mount()
    {
        $this->categories = Category::all();
        $this->products = Product::all();
    }

    public function filter()
    {
        $query = Order::query();

        if (!empty($this->startDate)) {
            $query->whereDate('created_at', '>=', $this->startDate);
        }

        if (!empty($this->endDate)) {
            $query->whereDate('created_at', '<=', $this->endDate);
        }

        if ($this->status !== null && $this->status !== "") {
            $query->where('status', $this->status);
        }

        if (!empty($this->phone_number)) {
            $query->where('phone_number', 'like', '%' . $this->phone_number . '%');
        }

        return $query->orderBy('id', 'desc')->get();
    }

    public function render()
    {
        $orders = $this->filter();
        return view('livewire.orders.index', ['orders' => $orders]);
    }
}
