@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Serial Number</h4>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    List Serial Number
                </h5>
                <a href="{{route('admin.serialnumber.create')}}" class="d-flex align-items-center">Add Serial Number</a>
            </div>
            <div class="card-body p-4 border-top">
                <table class="table table-striped datatable">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Product ID</td>
                        <td>Barang</td>
                        <td>Serial Number</td>
                        <td>Price</td>
                        <td>Production Date</td>
                        <td>Warranty Start</td>
                        <td>Warranty Duration</td>
                        <td>Used</td>
                        <td class="text-center">Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($serialnumber as $i => $sernumb)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$sernumb->product_id}}</td>
                            <td>{{$sernumb->barang->product_name}}</td>
                            <td>{{$sernumb->product_id}}</td>
                            <td>{{\App\Helper\Helper::formatCurrency($sernumb->price)}}</td>
                            <td>{{$sernumb->prod_date}}</td>
                            <td>{{$sernumb->warranty_start}}</td>
                            <td>{{$sernumb->warranty_duration}}</td>
                            <td class="text-center">{{$sernumb->used ?? (old('used') ?? '') == "0" ? 'Tidak Terpakai' : 'Terpakai'}}</td>
                            <td class="text-center">
                                <a href="{{route('admin.serialnumber.edit', $sernumb)}}" data-bs-toggle="tooltip" data-bs-title="Edit">
                                    <i class="ti ti-edit"></i>
                                </a>
                                <a href="{{route('admin.serialnumber.destroy', $sernumb)}}" data-bs-toggle="tooltip" data-bs-title="Delete" class="ms-2">
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
