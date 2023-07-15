@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">{{ isset($product) ? 'Edit' : 'Add' }} Product</h4>
        <div class="row">
            <div class="col-md-4">
                @include('layouts.alert')
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            Form {{ isset($product) ? 'Edit' : 'Add' }} Product
                        </h5>
                    </div>
                    <div class="card-body p-4 border-top">
                        <form action="{{isset($product) ? route('admin.products.update', $product) : route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($product))
                                @method('PUT')
                            @endif
                            <div class="form-group mb-2">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{$product->name ?? (old('name') ?? '')}}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" cols="30" rows="5">{{$product->description ?? (old('description') ?? '')}}</textarea>
                            </div>
                            <div class="form-group mb-2">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    @foreach(\App\Models\ProductCategory::all() as $category)
                                    <option value="{{$category->id}}" {{$product->category_id ?? (old('category_id') ?? '') == $category->id ? 'selected' : ''}}>
                                        {{$category->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="brand_id">Brand</label>
                                <select name="brand_id" id="brand_id" class="form-control">
                                    @foreach(\App\Models\ProductBrand::all() as $brand)
                                        <option value="{{$brand->id}}" {{$product->brand_id ?? (old('brand_id') ?? '') == $brand->id ? 'selected' : ''}}>
                                            {{$brand->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                @if(isset($product))
                                    <div class="mb-2 mt-3">
                                        <img src="{{$product->image}}" style="width: 100px;" alt="image">
                                    </div>
                                @endif
                                <label for="image">Image</label>
                                <input type="file" id="image" name="image" class="form-control">
                            </div>
                            <div class="form-group mb-2">
                                <label for="stock">Stock</label>
                                <input type="number" min="0" name="stock" id="stock" class="form-control" value="{{$product->stock ?? (old('stock') ?? '')}}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="buy_price">Buy Price</label>
                                <input type="number" min="0" name="buy_price" id="buy_price" class="form-control" value="{{$product->buy_price ?? (old('buy_price') ?? '')}}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="sell_price">Sell Price</label>
                                <input type="number" min="0" name="sell_price" id="sell_price" class="form-control" value="{{$product->sell_price ?? (old('sell_price') ?? '')}}">
                            </div>
                            <div class="mt-4 d-flex align-items-center justify-content-between">
                                <a href="{{route('admin.products.index')}}" class="btn btn-outline-primary">Cancel</a>

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
