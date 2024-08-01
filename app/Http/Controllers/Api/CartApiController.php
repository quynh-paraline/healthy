<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartApiController extends Controller
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

        $user = Auth::user();
        return response()->json([
            "products" => $products,
            "categories" => $categories,
            "total" => $total,
            "user" => $user
        ]);
    }

    public function count()
    {
        $cart = session()->has("cart") ? session()->get("cart") : [];
        $count = count($cart);
        return response()->json(['count' => $count]);
    }

    public function add($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $request = request();
        $cart = session()->has("cart") ? session()->get("cart") : [];
        $qty = $request->has("qty") ? $request->get("qty") : 1;

        foreach ($cart as $item) {
            if ($item->id == $product->id) {
                $item->buy_qty += $qty;
                session(["cart" => $cart]);
                return response()->json(['message' => 'Product quantity updated in cart']);
            }
        }

        $product->buy_qty = $qty;
        $cart[] = $product;
        session(["cart" => $cart]);

        return response()->json(['message' => 'Product added to cart']);
    }

    public function remove($id)
    {
        $cart = session()->has("cart") ? session()->get("cart") : [];
        if ($cart) {
            foreach ($cart as $key => $item) {
                if ($item['id'] == $id) {
                    unset($cart[$key]);
                    session(["cart" => array_values($cart)]); // Re-index the array after removing an item
                    return response()->json(['message' => 'Product removed from cart'], 200);
                }
            }
        }

        return response()->json(['message' => 'Product not found in cart'], 404);
    }
    public function reduce($id)
    {
        $cart = session()->get("cart", []);

        if ($cart) {
            foreach ($cart as $key => $item) {
                if ($item['id'] == $id) {
                    $cart[$key]['buy_qty']--;
                    if ($cart[$key]['buy_qty'] == 0) {
                        unset($cart[$key]);
                    }
                    session(["cart" => array_values($cart)]);
                    return response()->json(['message' => 'Product quantity reduced in cart']);
                }
            }
        }

        return response()->json(['message' => 'Product not found in cart'], 404);
    }
}
