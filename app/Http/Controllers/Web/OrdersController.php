<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class OrdersController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();

        if (Auth::check()) {
            $user = Auth::user();
            $orders = Order::orderBy("id", "desc")->where('email', $user->email)->get();
            return view("web.orders.index", ["orders" => $orders,
                "categories" => $categories,
                "products" => $products,
                "user" => $user
            ]);
        } else {
            return redirect()->to(route("web.login"));
        }
    }

    public function invoice($id)
    {
        $order = Order::find($id);
        $categories = Category::all();
        $products = Product::all();
        return view("web.orders.detail", ["order" => $order, "categories" => $categories, "products" => $products]);
    }

    public function cancel($id)
    {
        $order = Order::find($id);
        $categories = Category::all();
        $order->status = 7;
        $order->save();

        return redirect()->route("web.orders.index", ["order" => $order, "categories" => $categories]);
    }

    public function returns($id)
    {
        $order = Order::find($id);
        $categories = Category::all();
        $order->status = 4;
        $order->save();

        return redirect()->route("web.orders.index", ["order" => $order, "categories" => $categories]);
    }
}
