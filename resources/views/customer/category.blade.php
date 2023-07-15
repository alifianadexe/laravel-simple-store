@extends('layouts.customer')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3">{{$category->name}}</h4>

        <div class="row">
            @foreach($category->products as $product)
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{$product->brand->logo}}" alt="{{$product->brand->name}}" style="height: 32px;" class="me-2">
                            {{--                            <h6 class="card-subtitle text-muted m-0">--}}
                            {{--                                {{$product->brand->name}}--}}
                            {{--                            </h6>--}}
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
    </div>
@endsection
