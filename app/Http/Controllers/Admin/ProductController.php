<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $request = request();
        $content = $request->get("content");
        $categories = Category::all();
        $u = auth()->user();
        if ($content) {
            $products = Product::orderBy("id", "desc")->where("name", "like", "%$content%")->paginate(10);
        } else {
            $products = Product::orderBy("id", "desc")->paginate(10);
        }
        return view("admin.products.index",
            ["products" => $products,
            "categories" => $categories,
            "u"=>$u
            ]
        );
    }

    public function create()
    {
        $categories = Category::all();
        return view("admin.products.create", ["categories" => $categories]);
    }

    public function store()
    {
        $request = request();
        request()->validate([
            "name" => "required",
            "price" => "required|numeric|min:0",
            "qty" => "required|numeric|min:0"
        ], [
            "required" => "Vui lòng điền đầy đủ thông tin trước khi xác nhận!",
            "min" => "Phải nhập tối thiểu :min",
            "max" => "Nhập giá trị không vượt quá :max"
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

        $request->session()->flash('success', 'Product created successfully!');

        return redirect()->to(route("admin.products.index"));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view("admin.products.edit",
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
        ], [
            "required" => "Vui lòng điền đầy đủ thông tin trước khi xác nhận!",
            "min" => "Phải nhập tối thiểu :min",
            "max" => "Nhập giá trị không vượt quá :max"
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

        $request->session()->flash('success', 'Product updated successfully!');

        return redirect()->to(route("admin.products.index"));
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        session()->flash('danger', 'Product deleted successfully!');
        return redirect()->to(route("admin.products.index"));
    }
}
