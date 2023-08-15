@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">{{ isset($serialnumber) ? 'Edit' : 'Add' }} Serial Number</h4>
        <div class="row">
            <div class="col-md-4">
                @include('layouts.alert')
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            Form {{ isset($serialnumber) ? 'Edit' : 'Add' }} Serial Number
                        </h5>
                    </div>
                    <div class="card-body p-4 border-top">
                        <form action="{{isset($serialnumber) ? route('admin.serialnumber.update', $serialnumber) : route('admin.serialnumber.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($serialnumber))
                                @method('PUT')
                            @endif
                            <div class="form-group mb-2">
                                <label for="product_id">Produk Barang</label>
                                <select name="product_id" id="product_id" class="form-control">
                                    @foreach(\App\Models\Barang::all() as $barang)
                                        <option value="{{$barang->id}}" {{$serialnumber->product_id ?? (old('product_id') ?? '') == $barang->id ? 'selected' : ''}}>
                                            {{$barang->product_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="name">Serial Number</label>
                                <input type="text" name="serial_no" id="serial_no" class="form-control" value="{{$serialnumber->serial_no ?? (old('name') ?? '')}}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="price">Price</label>
                                <input type="text" name="price" id="price" class="form-control" value="{{$serialnumber->price ?? (old('price') ?? '')}}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="stock">Production Date</label>
                                <input type="date"name="prod_date" id="prod_date" class="form-control" value="{{$product->prod_date ?? (old('prod_date') ?? '')}}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="stock">Warranty Start</label>
                                <input type="date"name="warranty_start" id="warranty_start" class="form-control" value="{{$product->warranty_start ?? (old('warranty_start') ?? '')}}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="stock">Warranty Duration</label>
                                <input type="date"name="warranty_duration" id="warranty_duration" class="form-control" value="{{$product->warranty_duration ?? (old('warranty_duration') ?? '')}}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="product_id">Used</label>
                                <select name="used" id="used" class="form-control">
                                    <option value="0" {{$serialnumber->used ?? (old('used') ?? '') == "0" ? 'selected' : ''}}>
                                        Not Used
                                    </option>
                                    <option value="1" {{$serialnumber->used ?? (old('used') ?? '') == "1" ? 'selected' : ''}}>
                                        Used
                                     </option>
                                </select>
                            </div>
                            
                            <div class="mt-4 d-flex align-items-center justify-content-between">
                                <a href="{{route('admin.serialnumber.index')}}" class="btn btn-outline-primary">Cancel</a>

                                <button type="submit" class="btn btn-primary">
                                    {{isset($product) ? 'Update' : 'Save'}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
