<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\Transaction;
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

        $transactions = Transactions::orderBy('created_at', 'desc')->where('tipe_trans', 'SELL')->get();
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
        }

        return redirect()->back()->with('msg', 'Transaksi Berhasil Dibuat');
    }

    public function report()
    {
        $start = date('Y-m-d', strtotime('-14 days', strtotime(date('Y-m-d'))));
        $end = date('Y-m-d');

        // $transactions = Transactions::whereBetween('created_at', [$start, $end])->orderBy('created_at', 'asc')->get();

        // $profits = $transactions->groupBy('date')->mapWithKeys(function($transactions, $date) {
        //     $issued_capital = $transactions->filter(fn($transaction) => $transaction->status === 'success')->reduce(fn($total, $transaction) => $total += $transaction->products->reduce(fn($total2, $product) => $total2 += $product->buy_price * $product->pivot->quantity, 0), 0);
        //     $revenue = $transactions->filter(fn($transaction) => $transaction->status === 'success')->reduce(fn($total, $transaction) => $total += $transaction->products->reduce(fn($total2, $product) => $total2 += $product->pivot->total, 0), 0);
        //     $profit = $revenue - $issued_capital;
        //     return [date('d F Y', strtotime($date)) => $profit];
        // });

//        $brands = $transactions->flatMap(fn($transaction) => $transaction->products)->groupBy('brand_id')->mapWithKeys(function($products, $brand_id) {
//            $brand = ProductBrand::find($brand_id);
//            return [$brand->name => $products->count()];
//        })->sortKeys();

        // $brands = ProductBrand::orderBy('name')->get()->mapWithKeys(function ($brand) use ($transactions) {
        //     $count = $transactions->flatMap(fn($transaction) => $transaction->products)->filter(fn($product) => $product->brand_id === $brand->id)->count();
        //     return [$brand->name => $count];
        // });

        // $categories = ProductCategory::all()->mapWithKeys(function ($category) use ($transactions) {
        //     $count = $transactions->flatMap(fn($transaction) => $transaction->products)->filter(fn($product) => $product->category_id === $category->id)->count();
        //     return [$category->name => $count];
        // });

        // $products_counted = Product::all()->map(function($product) use ($transactions) {
        //     $product->sold = $transactions->flatMap(fn($transaction) => $transaction->products)->filter(fn($product2) => $product->id == $product2->id)->count();
        //     return $product;
        // });

        // $popular_products = $products_counted->sortByDesc('sold')->values()->slice(0, 4);
        // $unpopular_products = $products_counted->sortBy('sold')->values()->slice(0, 4);

        return view('admin.report');
    }
}
