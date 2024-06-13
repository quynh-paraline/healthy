<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{

    public function dashboard()
    {
        return view("admin.dashboard");
    }

    public function search()
    {
        $request = request();
        $content = $request->get("content");
        $categories = Category::all();
        $products = Product::where("name", "like", "%$content%")->get();

        return view("admin.products.index", [
            "categories" => $categories,
            "products" => $products
        ]);

    }
}
