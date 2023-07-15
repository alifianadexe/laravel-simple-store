<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Transaction;
use App\Models\User;
use Cassandra\Custom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

class CustomerController extends Controller
{

    public function home()
    {
        if (auth()->user() && auth()->user()->role_id != 3) {
            return redirect()->route('admin.dashboard');
        }

        $start = date('Y-m-d', strtotime('-14 days', strtotime(date('Y-m-d'))));
        $end = date('Y-m-d');

        $transactions = Transaction::whereBetween('created_at', [$start, $end])->orderBy('created_at', 'asc')->get();

        $products_counted = Product::all()->map(function($product) use ($transactions) {
            $product->sold = $transactions->flatMap(fn($transaction) => $transaction->products)->filter(fn($product2) => $product->id == $product2->id)->count();
            return $product;
        });

        $popular_products = $products_counted->sortByDesc('sold')->values()->slice(0, 4);

        $new_products = Product::orderBy('created_at', 'desc')->take(8)->get();

        return view('customer.home', compact('popular_products', 'new_products'));
    }

    public function category()
    {
        $args = func_get_args();

        $category = ProductCategory::whereSlug($args[count($args)-1])->first();

        if (request()->path() !== 'category/' . $category->full_slug) {
            return abort(404);
        }

        return view('customer.category', compact('category'));
    }

    public function cart(Request $request)
    {
        if ($request->isMethod('POST')) {
            $cart = (array) (request()->hasCookie('cart') ? json_decode(request()->cookie('cart')) : []);

            if (isset($cart[$request->product_id])) {
                $cart[$request->product_id] += 1;
            } else {
                $cart[$request->product_id] = 1;
            }

            Cookie::queue(Cookie::make('cart', json_encode($cart), 60));

            return response()->json(['message' => 'Product added to cart', 'total_cart' => collect($cart)->reduce(fn($carry, $item) => $carry+=$item, 0)]);
        }
        return view('customer.cart');
    }

    public function transactions(Request $request)
    {
        if ($request->isMethod('POST')) {
            if (auth()->guest()) {
                return redirect()->route('login');
            }

            $cart = collect((array) (request()->hasCookie('cart') ? json_decode(request()->cookie('cart')) : []))->map(function($quantity, $product_id) {
                $product = Product::find($product_id);
                return [
                    'quantity' => $quantity,
                    'total' => $product->sell_price * $quantity
                ];
            });

            $transaction = auth()->user()->customer->transactions()->create([
                'code' => strtoupper(uniqid()),
                'total' => $cart->reduce(fn($total, $product) => $total+=$product['total'], 0),
                'status' => 'pending',
            ]);
            $transaction->products()->sync( $cart );

            Cookie::queue(Cookie::make('cart', null, 0));

            return redirect()->route('transactions');
        }
        return view('customer.transactions');
    }

    public function index()
    {
        $customers = User::where('role_id', 3)->orderBy('created_at', 'desc')->get();
        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        $customer = null;
        return view('customer.form', compact('customer'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'sex' => ['required', 'in:Male,Female'],
            'username' => ['required', 'unique:users,username'],
            'password' => ['required', 'confirmed', 'min:6'],
            'born_place' => ['required'],
            'born_date' => ['required', 'date_format:Y-m-d'],
            'id_card_photo' => ['required', 'file', 'mimes:png,jpg,jpeg'],
            'address' => ['required'],
        ]);

        $id_card = $request->file('id_card_photo');
        $filename = '/id_cards/' . uniqid() . '.' . $id_card->getClientOriginalExtension();
        $id_card->storeAs('public', $filename);

        $user = User::create([
            'name' => $request->name,
            'sex' => $request->sex,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role_id' => 3
        ]);

        $user->customer()->create([
            'id_card_photo' => $filename,
            'born_place' => $request->born_place,
            'born_date' => $request->born_date,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('msg', 'Customer created successfully');
    }

    public function edit(Customer $customer)
    {
        return view('customer.form', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => ['required'],
            'sex' => ['required', 'in:Male,Female'],
            'username' => ['required', 'unique:users,username,' . $customer->user->id],
            'born_place' => ['required'],
            'born_date' => ['required', 'date_format:Y-m-d'],
            'id_card_photo' => ['file', 'mimes:png,jpg,jpeg'],
            'address' => ['required'],
        ]);

        $id_card = $request->file('id_card_photo');
        if ($id_card) {
            $filename = '/id_cards/' . uniqid() . '.' . $id_card->getClientOriginalExtension();
            $id_card->storeAs('public', $filename);
        } else {
            $filename = $customer->id_card_photo;
        }

        $customer->update([
            'id_card_photo' => $filename,
            'born_place' => $request->born_place,
            'born_date' => $request->born_date,
            'address' => $request->address,
        ]);

        $customer->user->update([
            'name' => $request->name,
            'sex' => $request->sex,
            'username' => $request->username,
        ]);

        return redirect()->back()->with('msg', 'Customer updated successfully');
    }
}
