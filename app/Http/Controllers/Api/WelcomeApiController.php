<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class WelcomeApiController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::paginate(9);
        return response()->json(["products" => $products, "categories" => $categories]);
    }
}
