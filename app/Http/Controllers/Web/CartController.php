<?php

namespace App\Http\Controllers\Web;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController
{
    public function index()
    {
        $products = session()->has("cart") ? session()->get("cart") : [];
        $categories = Category::all();
        $total = 0;
        foreach ($products as $item) {
            $total += $item->price * $item->buy_qty;
        }

        if ($total < 50) {
            $total += 3;
        }

        if (Auth::check()) {
            // Lấy người dùng hiện tại
            $user = Auth::user();
            return view("web.cart.index", [
                "products" => $products,
                "categories" => $categories,
                "total" => $total,
                "user" => $user
            ]);
        } else {
            return redirect()->to(route("web.login"));
        }

    }

    public function add($id)
    {
        $product = Product::find($id);
        $request = request();
        $cart = session()->has("cart") ? session()->get("cart") : [];
        $qty = $request->has("qty") ? $request->get("qty") : 1;
        foreach ($cart as $item) {
            if ($item->id == $product->id) {
                $item->buy_qty = $item->buy_qty + $qty;
                session(["cart" => $cart]);
                return redirect()->to(route("web.carts.index"));
            }
        }
        $product->buy_qty = $qty;
        $cart[] = $product;
        session(["cart" => $cart]);
        return redirect()->to(route("web.carts.index"));
    }

    public function remove($id)
    {
        $product = Product::find($id);
        $cart = session()->get("cart");

        if ($cart) {
            foreach ($cart as $key => $item) {
                if ($item->id == $product->id) {
                    unset($cart[$key]);
                    session(["cart" => $cart]);
                    break;
                }
            }
        }
        return redirect()->to(route("web.carts.index"));
    }

    public function reduce($id)
    {
        $product = Product::find($id);
        $cart = session()->get("cart");

        if ($cart) {
            foreach ($cart as $key => $item) {
                if ($item->id == $product->id) {
                    $item->qty--;
                    if ($item->qty == 0) {
                        unset($cart[$key]);
                        session(["cart" => $cart]);
                        break;
                    } else {

                        session(["cart" => $cart]);
                        break;
                    }
                }
            }
        }
        return redirect()->to(route("web.carts.index"));
    }

    public function checkout()
    {
        $products = session()->has("cart") ? session()->get("cart") : [];
        $categories = Category::all();
        $total = 0;
        foreach ($products as $item) {
            $total += $item->price * $item->buy_qty;
        }
        if ($total < 50) {
            $total += 3;
        }
        return view("web.checkouts.index", [
            "products" => $products,
            "categories" => $categories,
            "total" => $total]);
    }
}
