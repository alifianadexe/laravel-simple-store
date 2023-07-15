@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Brands</h4>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    List Brands
                </h5>
                <a href="{{route('admin.brands.create')}}" class="d-flex align-items-center">Add New Brand</a>
            </div>
            <div class="card-body p-4 border-top">
                <table class="table table-striped datatable">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Created Date</td>
                        <td class="text-center">Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($brands as $i => $brand)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$brand->name}}</td>
                            <td>{{$brand->created_at->format('F j, Y H:i')}}</td>
                            <td class="text-center">
                                <a href="{{route('admin.brands.edit', $brand)}}" data-bs-toggle="tooltip" data-bs-title="Edit">
                                    <i class="ti ti-edit"></i>
                                </a>
                                <a href="{{route('admin.brands.destroy', $brand)}}" data-bs-toggle="tooltip" data-bs-title="Delete" class="ms-2">
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
