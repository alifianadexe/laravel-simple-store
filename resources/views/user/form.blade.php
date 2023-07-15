@extends('layouts.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">{{ isset($user) ? 'Edit' : 'Add' }} User</h4>
        <div class="row">
            <div class="col-md-4">
                @include('layouts.alert')
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            Form {{ isset($user) ? 'Edit' : 'Add' }} User
                        </h5>
                    </div>
                    <div class="card-body p-4 border-top">
                        <form action="{{isset($user) ? route('admin.users.update', $user) : route('admin.users.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($user))
                                @method('PUT')
                            @endif
                            <div class="form-group mb-2">
                                <label for="role_id">Role</label>
                                <select name="role_id" id="role_id" class="form-control">
                                    <option value="1" {{$user->role_id ?? (old('role_id') ?? '') == '1' ? 'selected' : ''}}>Administrator</option>
                                    <option value="2" {{$user->role_id ?? (old('role_id') ?? '') == '2' ? 'selected' : ''}}>Staff</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{$user->name ?? (old('name') ?? '')}}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="sex">Gender</label>
                                <select name="sex" id="sex" class="form-control">
                                    <option value="Male" {{$user->sex ?? (old('sex') ?? '') == 'Male' ? 'selected' : ''}}>Male</option>
                                    <option value="Female" {{$user->sex ?? (old('sex') ?? '') == 'Female' ? 'selected' : ''}}>Female</option>
                                </select>
                            </div>
                            <hr class="mb-4">
                            <div class="form-group mb-2">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="{{$user->user->username ?? (old('username') ?? '')}}">
                            </div>
                            @if(!isset($user))
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
                                <a href="{{route('admin.users.index')}}" class="btn btn-outline-primary">Cancel</a>

                                <button type="submit" class="btn btn-primary">
                                    {{isset($user) ? 'Update' : 'Save'}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
