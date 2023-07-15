@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <h5 class="cart-title d-flex align-items-center mb-0">
                        Detail Order
                    </h5>
                </div>
            </div>
            <div class="card-body p-4 border-top">
                <h6 class="mb-2">Transaction Details</h6>
                <ul class="list-group">
                    <li class="list-group-item p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="mb-1">Code</h6>
                            <p class="mb-0">
                                {{$transaction->code}}
                            </p>
                        </div>

                        <div>
                           <h6 class="mb-1">Customer</h6>
                            <p class="mb-0">{{$transaction->customer->name}}</p>
                        </div>

                        <div>
                            <h6 class="mb-1">Order Date</h6>
                            <div>
                                {{$transaction->created_at->format('d F Y H:i')}}
                            </div>
                        </div>

                        <div>
                            <h6 class="mb-1">Status</h6>
                            <div>
                                <span class="badge text-capitalize bg-label-{{$transaction->status === 'success' ? 'success' : 'secondary'}}">
                                    {{$transaction->status}}
                                </span>
                            </div>
                        </div>

                        <div>
                            <h6 class="mb-1">Approved By</h6>
                            <div>
                                {{$transaction->status === 'success' ? $transaction->approver->name : '-'}}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card-body p-4 py-0">

                <h6 class="mb-2">Transaction Products</h6>
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
            <div class="card-body p-4 d-flex justify-content-between mt-3">
                @if($transaction->status === 'pending')
                <form action="{{route('admin.transactions.update', $transaction)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" class="btn text-danger d-flex align-items-center">
                        <i class="fa fa-trash-alt me-2"></i> Reject Order
                    </button>
                </form>
                <form action="{{route('admin.transactions.update', $transaction)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="success">
                    <button type="submit" class="btn btn-primary">Approve Order</button>
                </form>
                @elseif($transaction->status === 'success')
                    <form action="{{route('admin.transactions.update', $transaction)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="pending">
                        <button type="submit" class="btn btn-outline-primary d-flex align-items-center"><i class="ti ti-refresh me-2"></i> Rollback</button>
                    </form>
                @else
                    <form action="{{route('admin.transactions.destroy', $transaction)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger d-flex align-items-center"><i class="ti ti-trash me-2"></i> Delete</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
