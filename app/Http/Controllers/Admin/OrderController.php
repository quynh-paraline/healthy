<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy("id", "desc")->get();
        $categories = Category::all();
        $products = Product::all();
        return view("admin.orders.index", ["orders" => $orders,
            "categories" => $categories,
            "products" => $products
        ]);
    }

    public function detail($id)
    {
        $order = Order::find($id);
        $products = Product::all();
        $categories = Category::all();
        return view("admin.orders.detail", ["order" => $order,
            "products" => $products,
            "categories" => $categories
        ]);
    }

    public function filter()
    {
        $request = request();
        $startDate = $request->get("startDate");
        $endDate = $request->get("endDate");
        $status = $request->get("status");
        $phone_number = $request->get("phone_number");

        $query = Order::query();

        if (!empty($startDate)) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if (!empty($endDate)) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        if ($status !== null && $status !== "") {
            $query->where('status', $status);
        }

        if (!empty($phone_number)) {
            $query->where('phone_number', 'like', '%' . $phone_number . '%');
        }

        $orders = $query->orderBy("id", "desc")->get();

        return view('admin.orders.index', ["orders" => $orders]);

    }

    public function updateStatus($id)
    {
        $order = Order::find($id);
        $categories = Category::all();
        $order->status += 1;

        if ($order->status >= 3) {
            $order->is_paid = 1;
        }

        $order->save();

        Mail::to($order->email)->send(new OrderMail($order));

        session()->flash('success', 'Order updated status successfully!');

        return redirect()->route("admin.orders.detail", ["order" => $order, "categories" => $categories]);
    }

    public function cancelStatus($id)
    {
        $order = Order::find($id);
        $categories = Category::all();
        $order->status = 7;
        $order->save();

        Mail::to($order->email)->send(new OrderMail($order));

        return redirect()->route("admin.orders.detail", ["order" => $order, "categories" => $categories]);
    }

    public function cancelReturns($id)
    {
        $order = Order::find($id);
        $categories = Category::all();
        $order->status = 8;
        $order->save();

        Mail::to($order->email)->send(new OrderMail($order));

        return redirect()->route("admin.orders.detail", ["order" => $order, "categories" => $categories]);
    }
}
