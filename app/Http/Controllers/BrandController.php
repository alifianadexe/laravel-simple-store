<?php

namespace App\Http\Controllers;

use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = ProductBrand::orderBy('name', 'asc')->get();
        return view('brand.index', compact('brands'));
    }

    public function create()
    {
        $brand = null;
        return view('brand.form', compact('brand'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'logo' => ['required', 'file', 'mimes:png,jpg,jpeg'],
        ]);

        $image = $request->file('logo');
        $filename = '/brands/' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public', $filename);

        ProductBrand::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'logo' => $filename,
        ]);

        return redirect()->back()->with('msg', 'Brand created successfully');
    }

    public function edit(ProductBrand $brand)
    {
        return view('brand.form', compact('brand'));
    }

    public function update(Request $request, ProductBrand $brand)
    {
        $request->validate([
            'name' => ['required'],
            'logo' => [ 'file', 'mimes:png,jpg,jpeg'],
        ]);

        $image = $request->file('logo');
        if ($image) {
            $filename = '/brands/' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $filename);
            $brand->update([
                'logo' => $filename,
            ]);
        }

        $brand->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->back()->with('msg', 'Brand updated successfully');
    }
}
