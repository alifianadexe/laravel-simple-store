@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-12">Barang</h4>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    List Barang
                </h5>
                <a href="{{route('admin.barang.create')}}" class="d-flex align-items-center">Tambah Barang</a>
            </div>
            <div class="card-body p-4 border-top">
                <table class="table table-striped datatable">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Product Name</td>
                        <td>Brand</td>
                        <td>Price</td>
                        <td>Model No</td>
                        <td class="text-center">Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $i => $product)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->brand}}</td>
                            <td>{{\App\Helper\Helper::formatCurrency($product->price)}}</td>
                            <td>{{$product->model_no}}</td>
                            <td class="text-center">
                                <a href="{{route('admin.barang.edit', $product)}}" data-bs-toggle="tooltip" data-bs-title="Edit">
                                    <i class="ti ti-edit"></i>
                                </a>
                                <a href="{{route('admin.barang.destroy', $product)}}" data-bs-toggle="tooltip" data-bs-title="Delete" class="ms-2">
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
