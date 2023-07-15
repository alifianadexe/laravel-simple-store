<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $date = request('date') ?? date('Y-m-d');

        $transactions = Transaction::orderBy('created_at', 'desc')->where('status', '!=', 'pending')->whereDate('created_at', $date)->get();
        $transactions_pending = Transaction::orderBy('created_at')->where('status', 'pending')->whereDate('created_at', $date)->get();

        return view('admin.transaction.index', compact('transactions', 'transactions_pending'));
    }
    public function show($code)
    {
        $transaction = Transaction::whereCode($code)->first();
        return view('admin.transaction.show', compact('transaction'));
    }

    public function update(Request $request, $code)
    {
        $transaction = Transaction::whereCode($code)->first();
        $transaction->update([
            'status' => $request->status,
            'approved_by' => auth()->user()->id,
        ]);
        return redirect()->back()->with('msg', 'Transaction updated successful');
    }

    public function destroy($code)
    {
        $transaction = Transaction::whereCode($code)->first();
        $transaction->delete();
        return redirect()->route('admin.transactions.index')->with('msg', 'Transaction deleted successful');
    }

    public function report()
    {
        $start = date('Y-m-d', strtotime('-14 days', strtotime(date('Y-m-d'))));
        $end = date('Y-m-d');

        $transactions = Transaction::whereBetween('created_at', [$start, $end])->orderBy('created_at', 'asc')->get();

        $profits = $transactions->groupBy('date')->mapWithKeys(function($transactions, $date) {
            $issued_capital = $transactions->filter(fn($transaction) => $transaction->status === 'success')->reduce(fn($total, $transaction) => $total += $transaction->products->reduce(fn($total2, $product) => $total2 += $product->buy_price * $product->pivot->quantity, 0), 0);
            $revenue = $transactions->filter(fn($transaction) => $transaction->status === 'success')->reduce(fn($total, $transaction) => $total += $transaction->products->reduce(fn($total2, $product) => $total2 += $product->pivot->total, 0), 0);
            $profit = $revenue - $issued_capital;
            return [date('d F Y', strtotime($date)) => $profit];
        });

//        $brands = $transactions->flatMap(fn($transaction) => $transaction->products)->groupBy('brand_id')->mapWithKeys(function($products, $brand_id) {
//            $brand = ProductBrand::find($brand_id);
//            return [$brand->name => $products->count()];
//        })->sortKeys();

        $brands = ProductBrand::orderBy('name')->get()->mapWithKeys(function ($brand) use ($transactions) {
            $count = $transactions->flatMap(fn($transaction) => $transaction->products)->filter(fn($product) => $product->brand_id === $brand->id)->count();
            return [$brand->name => $count];
        });

        $categories = ProductCategory::all()->mapWithKeys(function ($category) use ($transactions) {
            $count = $transactions->flatMap(fn($transaction) => $transaction->products)->filter(fn($product) => $product->category_id === $category->id)->count();
            return [$category->name => $count];
        });

        $products_counted = Product::all()->map(function($product) use ($transactions) {
            $product->sold = $transactions->flatMap(fn($transaction) => $transaction->products)->filter(fn($product2) => $product->id == $product2->id)->count();
            return $product;
        });

        $popular_products = $products_counted->sortByDesc('sold')->values()->slice(0, 4);
        $unpopular_products = $products_counted->sortBy('sold')->values()->slice(0, 4);

        return view('admin.report', compact('profits', 'brands', 'categories', 'popular_products', 'unpopular_products'));
    }
}
