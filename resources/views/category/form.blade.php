@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">{{ isset($category) ? 'Edit' : 'Add' }} Category</h4>
        <div class="row">
            <div class="col-md-4">
                @include('layouts.alert')
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            Form {{ isset($category) ? 'Edit' : 'Add' }} Category
                        </h5>
                    </div>
                    <div class="card-body p-4 border-top">
                        <form action="{{isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($category))
                                @method('PUT')
                            @endif
                            <div class="form-group mb-2">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{$category->name ?? (old('name') ?? '')}}">
                            </div>
                            <div class="mt-4 d-flex align-items-center justify-content-between">
                                <a href="{{route('admin.categories.index')}}" class="btn btn-outline-primary">Cancel</a>

                                <button type="submit" class="btn btn-primary">
                                    {{isset($category) ? 'Update' : 'Save'}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
