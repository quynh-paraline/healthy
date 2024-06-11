<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        return view("admins.product_list",
            ["products" => $products],
            ["categories" => $categories]
        );
    }

    public function create()
    {
        $categories = Category::all();
        return view("admins.product_create", ["categories" => $categories]);
    }

    public function store()
    {
        $request = request();
        request()->validate([
            "name" => "required",
            "price" => "required|numeric|min:0",
            "qty" => "required|numeric|min:0"
        ]);

        $thumbnail = null;
        if ($request->hasFile("thumbnail")) {
            $file = $request->file("thumbnail");
            $fileName = time() . $file->getClientOriginalName();
            $path = public_path("uploads");
            $file->move($path, $fileName);
            $thumbnail = "/uploads/" . $fileName;
        }
        Product::create([
            "name" => request("name"),
            "price" => request("price"),
            "qty" => request("qty"),
            "thumbnail" => $thumbnail,
            "description" => request("description"),
            "category_id" => request("category_id"),
        ]);
        return redirect()->to(route("admin.products.index"));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view("admins.product_edit",
            ["categories" => $categories],
            ["product" => $product]
        );
    }

    public function update($id)
    {
        $product = Product::find($id);
        $request = request();

        request()->validate([
            "name" => "required",
            "price" => "required|numeric|min:0",
            "qty" => "required|numeric|min:0",
            "category_id" => "required|integer",
        ]);

        // throw errors

        $thumbnail = $product->thumbnail;
        if (request()->hasFile("thumbnail")) {
            $file = $request->file("thumbnail");
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = public_path("uploads");
            $file->move($path, $fileName);
            $thumbnail = "/uploads/" . $fileName;

            if ($product->thumbnail) {
                $oldThumbnail = public_path($product->thumbnail);
                if (file_exists($oldThumbnail)) {
                    unlink($oldThumbnail);
                }
            }
        }
        $product->name = request("name");
        $product->price = request("price");
        $product->qty = request("qty");
        $product->thumbnail = $thumbnail;
        $product->description = request("description");
        $product->category_id = request("category_id");
        $product->save();

        return redirect()->to(route("admin.products.index"));
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->to(route("admin.products.index"));
    }
}
