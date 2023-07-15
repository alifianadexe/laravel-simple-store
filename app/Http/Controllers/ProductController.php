<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('category_id', 'asc')->orderBy('brand_id', 'asc')->get();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $product = null;
        return view('product.form', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'image' => ['required', 'file', 'mimes:png,jpg,jpeg'],
            'category_id' => ['required', 'exists:product_categories,id'],
            'brand_id' => ['required', 'exists:product_brands,id'],
            'stock' => ['required', 'numeric'],
            'buy_price' => ['required', 'numeric'],
            'sell_price' => ['required', 'numeric'],
        ]);

        $image = $request->file('image');
        $filename = '/products/' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public', $filename);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'stock' => $request->stock,
            'buy_price' => $request->buy_price,
            'sell_price' => $request->sell_price,
            'image' => $filename,
        ]);

        return redirect()->back()->with('msg', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        return view('product.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'image' => ['file', 'mimes:png,jpg,jpeg'],
            'category_id' => ['required', 'exists:product_categories,id'],
            'brand_id' => ['required', 'exists:product_brands,id'],
            'stock' => ['required', 'numeric'],
            'buy_price' => ['required', 'numeric'],
            'sell_price' => ['required', 'numeric'],
        ]);

        if ($request->image) {
            $image = $request->file('image');
            $filename = '/products/' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $filename);

            $product->update([
                'image' => $filename,
            ]);
        }

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'stock' => $request->stock,
            'buy_price' => $request->buy_price,
            'sell_price' => $request->sell_price,
        ]);

        return redirect()->back()->with('msg', 'Product updated successfully');
    }
}
