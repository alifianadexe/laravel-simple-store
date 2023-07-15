@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Products</h4>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    List Products
                </h5>
                <a href="{{route('admin.products.create')}}" class="d-flex align-items-center">Add New Product</a>
            </div>
            <div class="card-body p-4 border-top">
                <table class="table table-striped datatable">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Image</td>
                        <td>Category</td>
                        <td>Brand</td>
                        <td class="text-center">Stock</td>
                        <td class="text-end">Sell Price</td>
                        <td>Created Date</td>
                        <td class="text-center">Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $i => $product)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->brand->name}}</td>
                            <td class="text-center">{{$product->stock}}</td>
                            <td class="text-end">{{$product->price}}</td>
                            <td>{{$product->created_at->format('F j, Y H:i')}}</td>
                            <td class="text-center">
                                <a href="{{route('admin.products.edit', $product)}}" data-bs-toggle="tooltip" data-bs-title="Edit">
                                    <i class="ti ti-edit"></i>
                                </a>
                                <a href="{{route('admin.products.destroy', $product)}}" data-bs-toggle="tooltip" data-bs-title="Delete" class="ms-2">
                                    <i class="ti ti-trash"></i>
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
