@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1">
                        Overview
                    </h5>
                    <span class="text-muted">
                        {{ request('date') === date('Y-m-d') ? 'Today' : date('F j, Y', strtotime(request('date'))) }}
                    </span>
                </div>
                <div class="d-flex align-items-center">
                    <form action="" id="form-date">
                        <input type="date" name="date" class="form-control" value="{{request('date') ?? date('Y-m-d')}}" onchange="document.getElementById('form-date').submit()">
                    </form>
                </div>
            </div>
            <div class="card-body p-4 border-top d-flex align-items-center justify-content-around">
                <div class="text-center">
                    <h5 class="mb-1">Transaction Success</h5>
                    <h4 class="mb-0">{{ $transactions->filter(fn($transaction) => $transaction->status === 'success')->count() }}</h4>
                </div>
                <div class="text-center">
                    <h5 class="mb-1">Products Sold</h5>
                    <h4 class="mb-0">{{ \App\Helper\Helper::formatCurrency($transactions->filter(fn($transaction) => $transaction->status === 'success')->reduce(fn($total, $transaction) => $total += $transaction->products->reduce(fn($total2, $product) => $total2 += $product->pivot->quantity, 0), 0), false) }}</h4>
                </div>
                <div class="text-center">
                    <h5 class="mb-1">Issued Capital</h5>
                    <h4 class="mb-0">{{ \App\Helper\Helper::formatCurrency($transactions->filter(fn($transaction) => $transaction->status === 'success')->reduce(fn($total, $transaction) => $total += $transaction->products->reduce(fn($total2, $product) => $total2 += $product->buy_price * $product->pivot->quantity, 0), 0)) }}</h4>
                </div>
                <div class="text-center">
                    <h5 class="mb-1">Revenue</h5>
                    <h4 class="mb-0">{{ \App\Helper\Helper::formatCurrency($transactions->filter(fn($transaction) => $transaction->status === 'success')->reduce(fn($total, $transaction) => $total += $transaction->products->reduce(fn($total2, $product) => $total2 += $product->pivot->total, 0), 0)) }}</h4>
                </div>
                <div class="text-center">
                    <h5 class="mb-1">Profit</h5>
                    <h4 class="mb-0">{{ \App\Helper\Helper::formatCurrency($transactions->filter(fn($transaction) => $transaction->status === 'success')->reduce(fn($total, $transaction) => $total += $transaction->products->reduce(fn($total2, $product) => $total2 += $product->pivot->total, 0), 0) - $transactions->filter(fn($transaction) => $transaction->status === 'success')->reduce(fn($total, $transaction) => $total += $transaction->products->reduce(fn($total2, $product) => $total2 += $product->buy_price * $product->pivot->quantity, 0), 0)) }}</h4>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    All Orders
                </h5>
                <a href="{{route('admin.transactions.create')}}" class="d-flex align-items-center">Tambah Transaksi</a>
            </div>
            <div class="card-body p-4 border-top">
                <table class="table table-striped datatable">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Tanggal</td>
                        <td>No Transaction</td>
                        <td>Customer</td>
                        <td class="text-center">Tipe Trans  </td>
                        <td class="text-center">Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $i => $transaction)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$transaction->tanggal}}</td>
                            <td>{{$transaction->no_trans}}</td>
                            <td>{{$transaction->customer}}</td>
                            <td class="text-center">
                                @if($transaction->tipe_trans === 'SELL')
                                    <span class="badge bg-label-danger">
                                        SELL
                                    </span>
                                @elseif($transaction->tipe_trans === 'BUY')
                                    <span class="badge bg-label-success">
                                        BUY
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{route('admin.transactions.show', $transaction)}}" data-bs-toggle="tooltip" data-bs-title="View details">
                                    <i class="ti ti-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    All Processed Orders
                </h5>
            </div>
            <div class="card-body p-4 border-top">
                <table class="table table-striped datatable">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Code</td>
                        <td>Customer Name</td>
                        <td>Order Date</td>
                        <td class="text-center">Status</td>
                        <td class="text-end">Total Amount (IDR)</td>
                        <td class="text-center">Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $i => $transaction)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$transaction->code}}</td>
                            <td>{{$transaction->customer->name}}</td>
                            <td>{{$transaction->created_at->format('Y-m-d H:i:s')}}</td>
                            <td class="text-center">
                                @if($transaction->status === 'pending')
                                    <span class="badge bg-label-secondary">
                                        Pending
                                    </span>
                                @elseif($transaction->status === 'success')
                                    <span class="badge bg-label-success">
                                        Success
                                    </span>
                                @elseif($transaction->status === 'rejected')
                                    <span class="badge bg-label-danger">
                                        Rejected
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">{{\App\Helper\Helper::formatCurrency($transaction->total, false)}}</td>
                            <td class="text-center">
                                <a href="{{route('admin.transactions.show', $transaction)}}" data-bs-toggle="tooltip" data-bs-title="View details">
                                    <i class="ti ti-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div> --}}
    </div>
@endsection
