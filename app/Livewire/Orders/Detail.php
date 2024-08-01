<?php

namespace App\Livewire\Orders;

use App\Mail\OrderMail;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Detail extends Component
{
    public $order;
    public $products;
    public $categories;
    public $orderId;

    public function mount($id)
    {
        $this->orderId = $id;
        $this->order = Order::find($this->orderId);
        $this->products = Product::all();
        $this->categories = Category::all();
    }

    public function updateStatus()
    {
        $this->order->status += 1;

        if ($this->order->status >= 3) {
            $this->order->is_paid = 1;
        }

        $this->order->save();

        Mail::to($this->order->email)->send(new OrderMail($this->order));

        $this->mount($this->orderId);
    }

    public function cancelStatus()
    {
        $this->order->status = 7;
        $this->order->save();

        Mail::to($this->order->email)->send(new OrderMail($this->order));

        $this->mount($this->orderId);
    }

    public function cancelReturns()
    {
        $this->order->status = 8;
        $this->order->save();

        Mail::to($this->order->email)->send(new OrderMail($this->order));

        $this->mount($this->orderId);
    }

    public function render()
    {
        return view('livewire.orders.detail');
    }
}
