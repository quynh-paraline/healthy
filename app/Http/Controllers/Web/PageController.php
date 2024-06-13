<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

class PageController extends Controller
{
    public function welcome()
    {
        $categories = Category::all();
        $products = Product::limit(8)->get();
        return view("web.welcome", ["categories" => $categories, "products" => $products]);
    }

    public function shop()
    {
        $categories = Category::all();
        $products = Product::paginate(9);
        return view("web.shop", ["categories" => $categories, "products" => $products]);
    }

    public function productCategory($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        $products = Product::where("category_id", $id)->paginate(9);
        return view("web.products_category",
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

        return view("web.search", [
            "categories" => $categories,
            "products" => $products
        ]);
    }

    public function checkout()
    {
        return view("web.checkout");
    }

    public function contact()
    {
        return view("web.contact");
    }

    public function thankyou($id)
    {
        $order = Order::find($id);
        return view("web.thankyou", ["order" => $order]);
    }
}
