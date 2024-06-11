<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

class PageController extends Controller
{
    public function welcome()
    {
        $categories = Category::all();
        $products = Product::limit(8)->get();
        return view("pages.welcome", ["categories" => $categories, "products" => $products]);
    }

    public function shop()
    {
        $categories = Category::all();
        $products = Product::paginate(9);
        return view("pages.shop", ["categories" => $categories, "products" => $products]);
    }

    public function productCategory($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        $products = Product::where("category_id", $id)->paginate(9);
        return view("pages.products_category",
            ["products" => $products,
                "category" => $category,
                "categories" => $categories]
        );
    }

    public function search()
    {
        $request = request();
        $content = $request->get("content");
        $categories = Category::all();
        $products = Product::where("name", "like", "%$content%")->paginate(9);

        return view("pages.search", [
            "categories" => $categories,
            "products" => $products
        ]);
    }

    public function checkout()
    {
        return view("pages.checkout");
    }

    public function contact()
    {
        return view("pages.contact");
    }

    public function thankyou($id)
    {
        $order = Order::find($id);
        return view("pages.thankyou", ["order" => $order]);
    }
}
