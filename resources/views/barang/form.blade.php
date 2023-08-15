@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">{{ isset($barang) ? 'Edit' : 'Add' }} Barang</h4>
        <div class="row">
            <div class="col-md-12">
                @include('layouts.alert')
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            Form {{ isset($barang) ? 'Edit' : 'Add' }} Barang
                        </h5>
                    </div>
                    <div class="card-body p-4 border-top">
                        <form action="{{isset($barang) ? route('admin.barang.update', $barang) : route('admin.barang.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($barang))
                                @method('PUT')
                            @endif
                            <div class="form-group mb-2">
                                <label for="name">Product Name</label>
                                <input type="text" name="product_name" id="product_name" class="form-control" value="{{$barang->product_name ?? (old('name') ?? '')}}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="name">Brand</label>
                                <input type="text" name="brand" id="brand" class="form-control" value="{{$barang->brand ?? (old('brand') ?? '')}}">
                            </div>
                            
                            <div class="form-group mb-2">
                                <label for="name">Price</label>
                                <input type="text" name="price" id="price" class="form-control" value="{{$barang->price ?? (old('price') ?? '')}}">
                            </div>
                            
                            <div class="form-group mb-2">
                                <label for="name">Model No</label>
                                <input type="text" name="model_no" id="model_no" class="form-control" value="{{$barang->model_no ?? (old('brand') ?? '')}}">
                            </div>

                            
                            <div class="mt-4 d-flex align-items-center justify-content-between">
                                <a href="{{route('admin.barang.index')}}" class="btn btn-outline-primary">Cancel</a>

                                <button type="submit" class="btn btn-primary">
                                    {{isset($barang) ? 'Update' : 'Save'}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
