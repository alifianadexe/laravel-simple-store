<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::orderBy('name', 'asc')->get();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        $category = null;
        return view('category.form', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        ProductCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->back()->with('msg', 'Category created successfully');
    }

    public function edit(ProductCategory $category)
    {
        return view('category.form', compact('category'));
    }

    public function update(Request $request, ProductCategory $category)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->back()->with('msg', 'Category updated successfully');
    }
}
