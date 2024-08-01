<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductsApiController extends Controller
{
    public function index()
    {
        $request = request();
        $content = $request->input('content');
        $query = Product::query();

        if ($content !== null && $content !== '') {
            $query->where('name', 'like', "%$content%");
        }

        $products = $query->paginate(9);
        return response()->json($products);
    }

    public function filter($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $products = Product::where('category_id', $id)->paginate(9);
        return response()->json(['category' => $category, 'products' => $products]);
    }
}
