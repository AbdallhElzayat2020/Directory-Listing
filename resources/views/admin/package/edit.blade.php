@extends('admin.dashboard.layouts.master')

@section('dashboard_title', 'Edit Package-'.$package->name)

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.packages.index') }}" class="btn btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <h1>Edit Package</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.packages.index') }}">Packages</a>
                </div>
                <div class="breadcrumb-item">Edit Package - {{$package->name}}</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Package - {{$package->name}}</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h4>Edit Package <span class="text-danger">(For Unlimited Quantity use -1)</span></h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.packages.update',$package->id) }}" method="POST">

                                @csrf
                                @method('PUT')

                                <div class="row">

                                    {{-- Package Type --}}
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Package Type <span class="text-danger">*</span></label>
                                            <select name="package_type" class="form-control">
                                                <option value="">Select Type</option>
                                                <option value="free" @selected(old('package_type',$package->package_type) == 'free')>Free</option>
                                                <option value="paid" @selected(old('package_type',$package->package_type) == 'paid')>Paid</option>
                                            </select>

                                            @error('package_type')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Name --}}
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name"
                                                   class="form-control"
                                                   placeholder="Enter package name"
                                                   value="{{ old('name',$package->name) }}">

                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Price --}}
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Price ($) <span class="text-danger">*</span></label>
                                            <input type="number" step="0.01" name="price"
                                                   class="form-control"
                                                   placeholder="0.00"
                                                   value="{{ old('price', $package->price) }}">

                                            @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Description --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Description <span class="text-danger">*</span></label>
                                            <textarea name="description" rows="5" class="form-control"
                                                      placeholder="Enter description">{{ old('description',$package->description) }}</textarea>
                                            @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Number of Days --}}
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Number of Days <span class="text-danger">*</span></label>
                                            <input type="number" name="number_of_days"
                                                   class="form-control"
                                                   placeholder="e.g. 30"
                                                   value="{{ old('number_of_days', $package->number_of_days) }}">

                                            @error('number_of_days')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Number of Listings --}}
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Number of Listings <span class="text-danger">*</span></label>
                                            <input type="number" name="number_of_listings"
                                                   class="form-control"
                                                   placeholder="e.g. 10"
                                                   value="{{ old('number_of_listings', $package->number_of_listings) }}">

                                            @error('number_of_listings')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Number of Photos --}}
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Number of Photos <span class="text-danger">*</span></label>
                                            <input type="number" name="number_of_photos"
                                                   class="form-control"
                                                   placeholder="e.g. 5"
                                                   value="{{ old('number_of_photos', $package->number_of_photos) }}">

                                            @error('number_of_photos')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Number of Videos --}}
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Number of Videos <span class="text-danger">*</span></label>
                                            <input type="number" name="number_of_videos"
                                                   class="form-control"
                                                   placeholder="e.g. 2"
                                                   value="{{ old('number_of_videos', $package->number_of_videos) }}">

                                            @error('number_of_videos')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Number of Amenities --}}
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Number of Amenities <span class="text-danger">*</span></label>
                                            <input type="number" name="number_of_amenities"
                                                   class="form-control"
                                                   placeholder="e.g. 10"
                                                   value="{{ old('number_of_amenities', $package->number_of_amenities) }}">

                                            @error('number_of_amenities')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Number of Featured Listings --}}
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Number of Featured Listings <span class="text-danger">*</span></label>
                                            <input type="number" name="number_of_featured_listings"
                                                   class="form-control"
                                                   placeholder="e.g. 3"
                                                   value="{{ old('number_of_featured_listings', $package->number_of_featured_listings) }}">

                                            @error('number_of_featured_listings')
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
                                                <option value="yes" @selected(old('show_at_home',$package->show_at_home) == 'yes')>Yes</option>
                                                <option value="no" @selected(old('show_at_home',$package->show_at_home) == 'no')>No</option>
                                            </select>

                                            @error('show_at_home')
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
                                                <option value="active" @selected(old('status',$package->status) == 'active')>Active</option>
                                                <option value="inactive" @selected(old('status',$package->status) == 'inactive')>Inactive</option>
                                            </select>

                                            @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">
                                        Create Package
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
