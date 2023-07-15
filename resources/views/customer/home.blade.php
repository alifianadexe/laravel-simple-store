@extends('layouts.customer')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold pt-4 pb-1">Featured Products</h4>

        <div class="row">
            @foreach($popular_products as $product)
                <div class="col-md-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{$product->brand->logo}}" alt="{{$product->brand->name}}" style="height: 32px;" class="me-2">
                            </div>
                            <h5 class="card-title">{{$product->name}}</h5>
                            <img class="img-fluid d-flex mx-auto my-3 rounded" src="{{ $product->image }}" alt="{{ $product->name }}">
                            <div class="mb-3">
                                <h4 class="card-text mb-0">
                                    {{$product->price}}
                                </h4>
                                <h6 class="text-warning fw-normal">
                                    <del>{{$product->from_price}}</del>
                                </h6>
                            </div>
                            <div class="row align-items-center d-flex">
                                <div class="col-7">
                                    <a href="javascript:void(0);" class="btn btn-outline-primary w-100 add-to-cart" data-id="{{$product->id}}">Add to Cart</a>
                                </div>
                                <div class="col-5">
                                    <a href="javascript:void(0);" class="card-link w-100 text-center">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h4 class="fw-bold pt-4 pb-1">New Products</h4>

        <div class="row">
            @foreach($new_products as $product)
                <div class="col-md-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{$product->brand->logo}}" alt="{{$product->brand->name}}" style="height: 32px;" class="me-2">
                            </div>
                            <h5 class="card-title">{{$product->name}}</h5>
                            <img class="img-fluid d-flex mx-auto my-3 rounded" src="{{ $product->image }}" alt="{{ $product->name }}">
                            <div class="mb-3">
                                <h4 class="card-text mb-0">
                                    {{$product->price}}
                                </h4>
                                <h6 class="text-warning fw-normal">
                                    <del>{{$product->from_price}}</del>
                                </h6>
                            </div>
                            <div class="row align-items-center d-flex">
                                <div class="col-7">
                                    <a href="javascript:void(0);" class="btn btn-outline-primary w-100 add-to-cart" data-id="{{$product->id}}">Add to Cart</a>
                                </div>
                                <div class="col-5">
                                    <a href="javascript:void(0);" class="card-link w-100 text-center">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h4 class="fw-bold pt-4 pb-1">Brands</h4>
        <div class="d-flex align-items-center justify-content-between mb-4">
            @foreach(\App\Models\ProductBrand::orderBy('name')->get() as $brand)
                <a href="{{route('brand', $brand)}}">
                    <img src="{{$brand->logo}}" alt="{{$brand->name}}" style="height: 40px" class="mx-3">
                </a>
            @endforeach
        </div>

        <h4 class="fw-bold pt-4 pb-1">Categories</h4>
        <div class="d-flex align-items-center justify-content-between">
            @foreach(\App\Models\ProductCategory::get() as $category)
                <a href="{{route('category', $category)}}">
                    <h3>{{$category->name}}</h3>
                </a>
            @endforeach
        </div>
    </div>
@endsection
