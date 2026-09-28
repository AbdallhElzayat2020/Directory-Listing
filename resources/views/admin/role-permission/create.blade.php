@extends('admin.dashboard.layouts.master')

@section('dashboard_title', 'Create Role')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.role.index') }}" class="btn btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <h1>Create Role</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.role.index') }}">Roles</a>
                </div>
                <div class="breadcrumb-item">Create Role</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Create Role</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h4>Create Role</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.role.store') }}" method="POST">

                                @csrf

                                <div class="row">


                                    {{-- Name --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Role Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control"
                                                   placeholder="Enter role name" value="{{ old('name') }}">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    {{-- Permissions --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">


                                            @foreach($permissions as $groupName => $permission)

                                                <div class="form-group">
                                                    <h6>{{$groupName}} Permissions</h6>
                                                    <div class="row">
                                                        @foreach($permission as $item)
                                                            <div class="col-md-2">
                                                                <div class="control-label">{{$item->name}}</div>
                                                                <label class="custom-switch mt-2">
                                                                    <input @selected(in_array($item->name, old('permissions',   [])))
                                                                           type="checkbox" name="permissions[]" value="{{$item->name}}" class="custom-switch-input">
                                                                    <span class="custom-switch-indicator"></span>
                                                                    <span class="custom-switch-description">{{$item->name}}</span>
                                                                </label>
                                                                <hr>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach


                                            @error('permissions')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">
                                            Create
                                        </button>
                                    </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
