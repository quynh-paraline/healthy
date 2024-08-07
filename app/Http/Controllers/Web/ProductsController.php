<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        $request = request();
        $categories = Category::all();
        $content = $request->get("content");

        if ($content) {
            $products = Product::where("name", "like", "%$content%")->paginate(9);
        } else {
            $products = Product::paginate(9);
        }

        return view("web.products.index", ["categories" => $categories, "products" => $products, "content" => $content]);
    }

    public function filter($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        $products = Product::where("category_id", $id)->paginate(9);

        return view("web.products.filter",
            ["products" => $products,
                "category" => $category,
                "categories" => $categories]
        );
    }
}
