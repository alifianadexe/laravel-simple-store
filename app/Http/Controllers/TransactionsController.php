<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\SerialNumber;
use App\Models\TransactionDetail;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionsController extends Controller
{
    public function index()
    {
        $date = request('date') ?? date('Y-m-d');

        $transactions = Transactions::orderBy('created_at', 'desc')->get();
        // $transactions_pending = Transactions::orderBy('created_at')->where('status', 'pending')->whereDate('created_at', $date)->get();

        return view('admin.transaction.index', compact('transactions'));
    }

    public function create()
    {
        $transactions = null;
        return view('admin.form', compact('transactions'));
    }

    public function show($id)
    {
        $transaction = Transactions::where('id', $id)->first();
        $transaction_detail = TransactionDetail::where('transaction_id', $id)->get();
        return view('admin.transaction.show', compact('transaction', 'transaction_detail'));
    }


    public function store(Request $request){
        // $transactions = Transaction::whereCode($code)->first();
        
        $request->validate([
            'customer' => ['required'],
            'check_product' => ['required']
        ]);

        $transaction_id = Transactions::create([
            'tanggal' => date('Y-m-d'),
            'no_trans' => Str::uuid(),
            'customer' => $request->customer,
            'tipe_trans' => 'SELL',
        ]);
       
        foreach($request->check_product as $product_id){
            $serialnum = SerialNumber::whereId($product_id)->first();
            TransactionDetail::create([
                'transaction_id' => $transaction_id->id,
                'product_id' => $serialnum->product_id,
                'serial_no' =>  $serialnum->serial_no,
                'serial_no_id' => $serialnum->id,
                'price' => $serialnum->price,
                'discount' => $request->discount
            ]);

            $serialnum->update([
                'used' => 1,
            ]);
        }

        return redirect()->back()->with('msg', 'Transaksi Berhasil Dibuat');
    }

    public function report()
    {
        $start = date('Y-m-d', strtotime('-14 days', strtotime(date('Y-m-d'))));
        $end = date('Y-m-d');

        $transactions = TransactionDetail::orderBy('created_at', 'asc')->get();
        $profits = Barang::all();

        $barang = Barang::orderBy('product_name')->get();
        $categories = Barang::all();
        
        $products_counted = SerialNumber::where('used', 0)->get();

        $popular_products = $products_counted->sortByDesc('created_at')->values()->slice(0, 4);
        $unpopular_products = $products_counted->sortBy('created_at')->values()->slice(0, 4);


        return view('admin.report', compact('profits', 'barang', 'categories', 'popular_products', 'unpopular_products'));
    }
}
