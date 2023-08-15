@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">{{ isset($transaction) ? 'Edit' : 'Add' }} Brand</h4>
        <div class="row">
            <div class="col-md-12">
                @include('layouts.alert')
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            Form {{ isset($transaction) ? 'Edit' : 'Add' }} Brand
                        </h5>
                    </div>
                    <div class="card-body p-4 border-top">
                        <form action="{{isset($transaction) ? route('admin.transactions.update', $transaction) : route('admin.transactions.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($transaction))
                                @method('PUT')
                            @endif
                            <div class="form-group mb-2">
                                <label for="name">Customer</label>
                                <input type="text" name="customer" id="customer" class="form-control" value="{{$transaction->customer ?? (old('name') ?? '')}}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="name">Discount</label>
                                <input type="text" name="discount" id="discount" class="form-control" value="{{$transaction->discount ?? (old('name') ?? '')}}">
                              
                            </div>
                            <div class="form-group mb-6">
                                <label for="product_id">Produk Barang</label>
                                <div class="card-body p-4 border-top">
                                    <table class="table table-striped datatable">
                                        <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Add</td>
                                            <td>Product Name</td>
                                            <td>Serial Number</td>
                                            <td>Price</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(\App\Models\SerialNumber::where('used', '0')->orderBy('created_at')->get() as $i => $sernumb)
                                            <tr>
                                                <td>{{$i+1}}</td>
                                                <td><input type="checkbox" name="check_product[]" id="check_product"  value="{{ $sernumb->id }}" /></td>
                                                <td>{{$sernumb->barang->product_name}}</td>
                                                <td>{{$sernumb->serial_no}}</td>
                                                <td>{{$sernumb->price}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="mt-4 d-flex align-items-center justify-content-between">
                                <a href="{{route('admin.brands.index')}}" class="btn btn-outline-primary">Cancel</a>

                                <button type="submit" class="btn btn-primary">
                                    {{isset($brand) ? 'Update' : 'Save'}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
