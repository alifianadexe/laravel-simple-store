<?php

namespace App\Http\Controllers;

use App\Models\ProductBrand;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    public function index()
    {
        $products = Barang::orderBy('product_name', 'asc')->get();
        return view('barang.index', compact('products'));
    }

    public function create()
    {
        $barang = null;
        return view('barang.form', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => ['required'],
        ]);

        Barang::create([
            'product_name' => $request->product_name,
            'brand' => $request->brand,
            'price' => $request->price,
            'model_no' => $request->model_no,
        ]);

        return redirect()->back()->with('msg', 'Produk Barang Berhasil Dibuat');
    }

    public function edit(Barang $barang)
    {
        return view('barang.form', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'product_name' => ['required'],
           
        ]);

        $barang->update([
            'product_name' => $request->name,
            'brand' => $request->brand,
            'price' => $request->price,
            'model_no' => $request->model_no,
        ]);

        return redirect()->back()->with('msg', 'Produk updated successfully');
    }
}
