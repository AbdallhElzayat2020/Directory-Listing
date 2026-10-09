@extends('admin.dashboard.layouts.master')

@section('dashboard_title','Edit Role User')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Role User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.role-users.index') }}">Role Users</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Role User</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Role User</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.role-users.update',$user->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row my-4">

                                    {{-- Name --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="name">Name <span class="text-danger">*</span></label>
                                            <input type="text" id="name" placeholder="Please enter the name"
                                                   name="name" value="{{ old('name',$user->name) }}" class="form-control">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input type="text" id="email" placeholder="Please enter the email"
                                                   name="email" value="{{ old('email',$user->email) }}" class="form-control">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Password --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="password">Password <span class="text-danger">*</span></label>
                                            <input type="text" id="password" placeholder="Please enter the password"
                                                   name="password" value="{{ old('password') }}" class="form-control">
                                            @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Password Confirmation --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="password_confirmation">Password Confirmation <span class="text-danger">*</span></label>
                                            <input type="text" id="password_confirmation" placeholder="Please enter the password confirmation"
                                                   name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">
                                            @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Role --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="role">Role <span class="text-danger">*</span></label>
                                            <select name="role" id="role" class="form-control">
                                                <option value="">Select a role</option>
                                                @foreach($roles as $role)
                                                    <option @selected(old('role', $user->getRoleNames()->first()) == $role->name) value="{{$role->name}}">
                                                        {{$role->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
