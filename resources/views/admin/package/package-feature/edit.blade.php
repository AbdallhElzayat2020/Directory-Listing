@extends('admin.dashboard.layouts.master')

@section('dashboard_title', 'Edit Package Feature')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.package-features.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Package Feature</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Package Feature</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.package-features.update', $packageFeature->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    {{-- Select Package --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Package <span class="text-danger">*</span></label>
                                            <select name="package_id" class="form-control">
                                                <option value="">Select Package</option>
                                                @foreach ($packages as $package)
                                                    <option value="{{ $package->id }}" @selected(old('package_id', $packageFeature->package_id) == $package->id)>
                                                        {{ $package->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('package_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-control">
                                                <option value="active" @selected(old('status', $packageFeature->status) == 'active')>Active</option>
                                                <option value="inactive" @selected(old('status', $packageFeature->status) == 'inactive')>Inactive</option>
                                            </select>
                                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    {{-- Feature Text --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Feature Description <span class="text-danger">*</span></label>
                                            <input type="text" name="feature" class="form-control" value="{{ old('feature', $packageFeature->feature) }}">
                                            @error('feature') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Update Feature</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
