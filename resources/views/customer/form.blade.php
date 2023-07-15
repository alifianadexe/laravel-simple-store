@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">{{ isset($customer) ? 'Edit' : 'Add' }} Customer</h4>
        <div class="row">
            <div class="col-md-4">
                @include('layouts.alert')
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            Form {{ isset($customer) ? 'Edit' : 'Add' }} Customer
                        </h5>
                    </div>
                    <div class="card-body p-4 border-top">
                        <form action="{{isset($customer) ? route('admin.customers.update', $customer) : route('admin.customers.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($customer))
                                @method('PUT')
                            @endif
                            <div class="form-group mb-2">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{$customer->name ?? (old('name') ?? '')}}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="sex">Gender</label>
                                <select name="sex" id="sex" class="form-control">
                                    <option value="Male" {{$customer->sex ?? (old('sex') ?? '') == 'Male' ? 'selected' : ''}}>Male</option>
                                    <option value="Female" {{$customer->sex ?? (old('sex') ?? '') == 'Female' ? 'selected' : ''}}>Female</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="born_place">Born Place</label>
                                <input type="text" name="born_place" id="born_place" class="form-control" value="{{$customer->born_place ?? (old('born_place') ?? '')}}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="born_date">Born Date</label>
                                <input type="date" name="born_date" id="born_date" class="form-control" value="{{$customer->born_date ?? (old('born_date') ?? '')}}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" class="form-control" cols="30" rows="5">{{$customer->address ?? (old('address') ?? '')}}</textarea>
                            </div>
                            <div class="form-group mb-4">
                                @if(isset($customer))
                                    <div class="mb-2 mt-3">
                                        <img src="{{asset('storage' . $customer->id_card_photo)}}" style="width: 100px;" alt="image">
                                    </div>
                                @endif
                                <label for="id_card_photo">Change ID Card Photo</label>
                                <input type="file" id="id_card_photo" name="id_card_photo" class="form-control">
                            </div>
                            <hr class="mb-4">
                            <div class="form-group mb-2">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="{{$customer->user->username ?? (old('username') ?? '')}}">
                            </div>
                            @if(!isset($customer))
                            <div class="form-group mb-2">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" value="">
                            </div>
                            <div class="form-group mb-2">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="">
                            </div>
                            @endif
                            <div class="mt-4 d-flex align-items-center justify-content-between">
                                <a href="{{route('admin.customers.index')}}" class="btn btn-outline-primary">Cancel</a>

                                <button type="submit" class="btn btn-primary">
                                    {{isset($customer) ? 'Update' : 'Save'}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
