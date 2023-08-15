<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SerialNumber;
use Illuminate\Http\Request;

class SerialNumberController extends Controller
{
    public function index()
    {
        $serialnumber = SerialNumber::orderBy('product_id', 'asc')->get();
        return view('serialnumber.index', compact('serialnumber'));
    }

    public function create()
    {
        $serialnumber = null;
        return view('serialnumber.form', compact('serialnumber'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'serial_no' => ['required'],
            'product_id' => ['required'],
        ]);

       
        SerialNumber::create([
            'serial_no' => $request->serial_no,
            'product_id' => $request->product_id,
            'price' => $request->price,
            'prod_date' => $request->prod_date,
            'warranty_start' => $request->warranty_start,
            'warranty_duration' => $request->warranty_duration,
            'used' => $request->used,
        ]);

        return redirect()->back()->with('msg', 'Serial Number created successfully');
    }

    public function edit(SerialNumber $serialnumber)
    {
        return view('serialnumber.form', compact('serialnumber'));
    }

    public function update(Request $request, SerialNumber $serialnumber)
    {
        $request->validate([
            'serial_no' => ['required'],
            'product_id' => ['required'],
        ]);

        $serialnumber->update([
            'serial_no' => $request->serial_no,
            'product_id' => $request->product_id,
            'price' => $request->price,
            'prod_date' => $request->prod_date,
            'warranty_start' => $request->warranty_start,
            'warranty_duration' => $request->warranty_duration,
            'used' => $request->used,
        ]);

        return redirect()->back()->with('msg', 'Product updated successfully');
    }
}
