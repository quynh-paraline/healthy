<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

class OrdersApiController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return response()->json([
            "orders" => $orders
        ]);
    }

    public function detail($id){
        $order = Order::with('products')->find($id);
        return response()->json([
            "order" => $order,
        ]);
    }
}
