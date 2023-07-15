@extends('layouts.customer')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3">My Shopping Bag ({{$cart->reduce(fn($carry, $item) => $carry+=$item, 0)}} Items)</h4>

        <div class="card">
            <div class="card-body">
                    <!-- Cart -->
                    <div id="checkout-cart" class="content active dstepper-block fv-plugins-bootstrap5 fv-plugins-framework">
                        <div class="row">
                            <!-- Cart left -->
                            <div class="col-xl-8 mb-3 mb-xl-0">

                                <ul class="list-group mb-3">
                                    @foreach($cart as $product_id => $quantity)
                                    @php
                                    $product = \App\Models\Product::find($product_id);
                                    @endphp
                                    <li class="list-group-item p-4">
                                        <div class="d-flex gap-3">
                                            <div class="flex-shrink-0 d-flex align-items-center">
                                                <img src="{{$product->image}}" alt="google home" class="w-px-100">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="row align-items-center">
                                                    <div class="col-md-8">
                                                        <p class="me-3 mb-1">
                                                            <a href="javascript:void(0)" class="text-body">{{$product->name}}</a>
                                                        </p>
                                                        <div class="text-muted mb-3 d-flex flex-wrap">
                                                            <span class="me-1">Brand:</span>
                                                            <a href="javascript:void(0)" class="me-3">
                                                                {{$product->brand->name}}
                                                            </a>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            Qty:
                                                            <span class="mx-3">
                                                                {{$quantity}}
                                                            </span>
                                                        </div>
{{--                                                        <input type="number" class="form-control form-control-sm w-px-75" value="{{$quantity}}" min="1" max="{{$product->stock}}">--}}
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="text-md-end">
                                                            <button type="button" class="btn-close btn-pinned" aria-label="Close"></button>
                                                            <div class="my-2 my-md-4 mb-md-5">
{{--                                                                <s class="text-muted me-2">{{$product->from_price}}</s>--}}
                                                                <span class="text-primary">{{$product->formatCurrency($product->sell_price * $quantity)}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>

                            </div>

                            <!-- Cart right -->
                            <div class="col-xl-4">
                                <div class="border rounded p-4 mb-3 pb-3">

                                    <!-- Price Details -->
                                    <h6>Price Details</h6>
                                    <dl class="row mb-0">

                                        <dt class="col-6 fw-normal">Order Total</dt>
                                        <dd class="col-6 text-end">
                                            {{\App\Models\Product::first()->formatCurrency($cart->reduce(fn($total, $quantity, $id) => $total += \App\Models\Product::find($id)->sell_price * $quantity, 0))}}
                                        </dd>

                                    </dl>

                                    <hr class="mx-n4">
                                    <dl class="row mb-0">
                                        <dt class="col-6">Total</dt>
                                        <dd class="col-6 fw-semibold text-end mb-0">{{\App\Models\Product::first()->formatCurrency($cart->reduce(fn($total, $quantity, $id) => $total += \App\Models\Product::find($id)->sell_price * $quantity, 0))}}</dd>
                                    </dl>
                                </div>
                                <div class="d-grid">
                                    <form action="{{route('transactions')}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Checkout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
@endsection
