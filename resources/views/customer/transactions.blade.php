@extends('layouts.customer')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3">List Transactions</h4>

        @foreach(auth()->user()->customer->transactions()->orderBy('created_at', 'desc')->get() as $transaction)
        <div class="card mb-4">
            <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <h6 class="cart-title d-flex align-items-center mb-0">
                        <i class="ti ti-calendar me-2"></i> {{date('F j, Y', strtotime($transaction->created_at))}}
                    </h6>
                    <span class="badge ms-3 text-capitalize bg-label-{{$transaction->status === 'success' ? 'success' : 'secondary'}}">
                        {{$transaction->status}}
                    </span>
                </div>
                <span class="d-flex align-items-center"><i class="ti ti-hash me-1"></i> {{$transaction->code}}</span>
            </div>
            <div class="card-body p-4">
                <ul class="list-group">

                    @foreach($transaction->products as $product)
                    <li class="list-group-item p-4">
                        <div class="d-flex gap-3">
                            <div class="flex-shrink-0">
                                <img src="{{$product->image}}" alt="{{$product->name}}" class="w-px-75">
                            </div>
                            <div class="flex-grow-1">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <a href="javascript:void(0)" class="text-body">
                                            <p class="mb-1">{{$product->name}}</p>
                                        </a>
                                        <div class="text-muted d-flex flex-wrap">
                                            <span class="me-1">Brand:</span>
                                            <a href="javascript:void(0)" class="me-3">{{$product->brand->name}}</a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <small>Qty: {{$product->pivot->quantity}}</small>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-md-end">
                                            <div class="my-2 my-lg-4">
                                                <span class="text-primary">{{$product->formatCurrency($product->pivot->total)}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    <li class="list-group-item p-4 d-flex justify-content-between fw-bold">
                        <span>Total</span>
                        <span>{{$product->formatCurrency($transaction->total)}}</span>
                    </li>

                </ul>
            </div>
        </div>
        @endforeach

    </div>
@endsection
