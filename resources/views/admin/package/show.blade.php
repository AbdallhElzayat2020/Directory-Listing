@extends('admin.dashboard.layouts.master')

@section('dashboard_title', 'Package Details')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.packages.index') }}" class="btn btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <h1>Package Details</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.packages.index') }}">Packages</a>
                </div>
                <div class="breadcrumb-item">View Package</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">{{ $package->name }}</h2>
            <p class="section-lead">Overview and limits configured for this subscription package.</p>

            <div class="row">
                {{-- Main Information Card --}}
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Package Overview</h4>
                            <div>
                                <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit Package
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="font-weight-bold text-muted">Package Name</label>
                                    <h5>{{ $package->name }}</h5>
                                </div>
                                <div class="col-md-6">
                                    <label class="font-weight-bold text-muted">Slug</label>
                                    <p><code>{{ $package->slug }}</code></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold text-muted">Description</label>
                                <div class="p-3 bg-light rounded">
                                    {!! nl2br(e($package->description)) !!}
                                </div>
                            </div>

                            <hr>

                            <h5 class="mt-4 mb-3">Limits & Quotas</h5>
                            <div class="row">
                                <div class="col-sm-6 col-lg-4 mb-3">
                                    <div class="border rounded p-3 text-center">
                                        <i class="fas fa-calendar-alt text-primary fa-2x mb-2"></i>
                                        <div class="text-muted small">Validity</div>
                                        <div class="h6 mb-0">{{ $package->number_of_days }} Days</div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-4 mb-3">
                                    <div class="border rounded p-3 text-center">
                                        <i class="fas fa-list text-info fa-2x mb-2"></i>
                                        <div class="text-muted small">Listings</div>
                                        <div class="h6 mb-0">{{ $package->number_of_listings }}</div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-4 mb-3">
                                    <div class="border rounded p-3 text-center">
                                        <i class="fas fa-images text-success fa-2x mb-2"></i>
                                        <div class="text-muted small">Photos per Listing</div>
                                        <div class="h6 mb-0">{{ $package->number_of_photos }}</div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-4 mb-3">
                                    <div class="border rounded p-3 text-center">
                                        <i class="fas fa-video text-danger fa-2x mb-2"></i>
                                        <div class="text-muted small">Videos per Listing</div>
                                        <div class="h6 mb-0">{{ $package->number_of_videos }}</div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-4 mb-3">
                                    <div class="border rounded p-3 text-center">
                                        <i class="fas fa-concierge-bell text-warning fa-2x mb-2"></i>
                                        <div class="text-muted small">Amenities Limit</div>
                                        <div class="h6 mb-0">{{ $package->number_of_amenities }}</div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-4 mb-3">
                                    <div class="border rounded p-3 text-center">
                                        <i class="fas fa-star text-warning fa-2x mb-2"></i>
                                        <div class="text-muted small">Featured Listings</div>
                                        <div class="h6 mb-0">{{ $package->number_of_featured_listings }}</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Sidebar Attributes --}}
                <div class="col-lg-4 col-md-12">
                    {{-- Pricing Box --}}
                    <div class="card card-hero">
                        <div class="card-header text-center">
                            <div class="card-icon"><i class="fas fa-tag"></i></div>
                            <h4>${{ number_format($package->price, 2) }}</h4>
                            <div class="card-description text-uppercase font-weight-bold">
                                {{ $package->package_type }} Package
                            </div>
                        </div>
                    </div>

                    {{-- Configurations & Status --}}
                    <div class="card">
                        <div class="card-header">
                            <h4>Status & Options</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Status
                                    @if($package->status === 'active')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Package Type
                                    <span class="badge badge-info text-capitalize">{{ $package->package_type }}</span>
                                </li>
                                
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Show At Home
                                    @if($package->show_at_home === 'yes')
                                        <span class="badge badge-primary">Yes</span>
                                    @else
                                        <span class="badge badge-secondary">No</span>
                                    @endif
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Created At
                                    <small class="text-muted">{{ $package->created_at?->format('Y-m-d H:i') ?? 'N/A' }}</small>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Last Updated
                                    <small class="text-muted">{{ $package->updated_at?->format('Y-m-d H:i') ?? 'N/A' }}</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
