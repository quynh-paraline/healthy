<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view("admin.categories.index", ["categories" => $categories]);
    }

    public function create()
    {
        return view("admin.categories.create");
    }

    public function store()
    {
        $request = request();
        $request->validate([
            "name" => "required",
            "thumbnail" => "required"
        ]);

        $thumbnail = null;
        if ($request->hasFile("thumbnail")) {
            $file = $request->file("thumbnail");
            $fileName = time() . $file->getClientOriginalName();
            $path = public_path("uploads");
            $file->move($path, $fileName);
            $thumbnail = "/uploads/" . $fileName;
        }
        Category::create([
            "name" => $request->get("name"),
            "thumbnail" => $thumbnail
        ]);
        return redirect()->to(route('admin.categories.index'));
    }

    public function edit(Category $category)
    {
        return view("admin.categories.edit", ["category" => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            "name" => "required",
            "thumbnail" => "required",
        ]);

        $thumbnail = $category->thumbnail;
        if ($request->hasFile("thumbnail")) {
            $file = $request->file("thumbnail");
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = public_path("uploads");
            $file->move($path, $fileName);
            $thumbnail = "/uploads/" . $fileName;

            if ($category->thumbnail) {
                $oldThumbnail = public_path($category->thumbnail);
                if (file_exists($oldThumbnail)) {
                    unlink($oldThumbnail);
                }
            }
        }
        $category->name = $request->get("name");
        $category->thumbnail = $thumbnail;
        $category->save();

        return redirect()->to(route("admin.categories.index"));
    }


    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->to("admin.categories.index");
    }
}
