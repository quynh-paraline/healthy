<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{

    public function dashboard()
    {
        return view("admins.dashboard");
    }

    public function search()
    {
        $request = request();
        $content = $request->get("content");
        $categories = Category::all();
        $products = Product::where("name", "like", "%$content%")->get();

        return view("admins.product_list", [
            "categories" => $categories,
            "products" => $products
        ]);

    }
}
