@extends('admin.dashboard.layouts.master')

@section('dashboard_title','Create Amenity')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.amenities.index') }}" class="btn btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <h1>Create Amenity</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.amenities.index') }}">Amenities</a>
                </div>
                <div class="breadcrumb-item">Create Amenity</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Create Amenity</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h4>Create Amenity</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.amenities.store') }}"
                                  method="POST"
                                  enctype="multipart/form-data">

                                @csrf

                                <div class="row">

                                    {{-- Title --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Title <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   name="title"
                                                   class="form-control"
                                                   placeholder="Enter category title"
                                                   value="{{ old('title') }}">

                                            @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Icon Image --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Icon Image <span class="text-danger">*</span> </label>
                                            <input type="file"
                                                   name="icon_image"
                                                   class="form-control"
                                                   accept="image/*">

                                            @error('icon_image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Background Image --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Background Image <span class="text-danger">*</span> </label>
                                            <input type="file"
                                                   name="bg_image"
                                                   class="form-control"
                                                   accept="image/*">

                                            @error('bg_image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Status <span class="text-danger">*</span></label>

                                            <select name="status" class="form-control">
                                                <option value="">Select Status</option>
                                                <option value="active" @selected(old('status') == 'active' )>
                                                    Active
                                                </option>
                                                <option value="inactive" @selected(old('status') == 'inactive' )>
                                                    Inactive
                                                </option>
                                            </select>

                                            @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Show At Home --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Show At Home <span class="text-danger">*</span></label>

                                            <select name="show_at_home" class="form-control">
                                                <option value="">Select Option</option>
                                                <option value="yes" {{ old('show_at_home') == 'yes' ? 'selected' : '' }}>
                                                    Yes
                                                </option>
                                                <option value="no" {{ old('show_at_home') == 'no' ? 'selected' : '' }}>
                                                    No
                                                </option>
                                            </select>

                                            @error('show_at_home')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Description --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Description</label>

                                            <textarea name="description" rows="6" class="form-control"
                                                      placeholder="Enter category description">{{ old('description') }}</textarea>

                                            @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
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
