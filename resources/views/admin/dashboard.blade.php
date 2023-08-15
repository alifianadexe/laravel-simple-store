@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Dashboard</h4>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    Incoming Orders
                </h5>
                {{-- <a href="{{route('admin.transactions.index')}}" class="d-flex align-items-center">View all transactions <i class="ti ms-2 ti-chevron-right"></i></a> --}}
                <a href="{{route('admin.transactions.create')}}" class="d-flex align-items-center">Tambah Transaksi</a>
            </div>
            <div class="card-body p-4 border-top">
                <table class="table table-striped datatable">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Code</td>
                        <td>Name</td>
                        <td>Order Date</td>
                        {{-- <td class="text-center">Products Count</td>
                        <td class="text-end">Total Amount</td> --}}
                        <td class="text-center">Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\Transactions::where('tipe_trans', 'SELL')->orderBy('created_at')->get() as $i => $transaction)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$transaction->id}}</td>
                            <td>{{$transaction->customer}}</td>
                            <td>{{$transaction->created_at->diffForHumans()}}</td>
                            {{-- <td class="text-center">{{$transaction->products->count()}}</td>
                            <td class="text-end">{{\App\Helper\Helper::formatCurrency($transaction->total)}}</td> --}}
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
    </div>
@endsection
