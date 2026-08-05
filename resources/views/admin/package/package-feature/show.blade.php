@extends('admin.dashboard.layouts.master')

@section('dashboard_title', 'Feature Details')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.package-features.index') }}" class="btn btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <h1>Feature Details</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.package-features.index') }}">Package Features</a></div>
                <div class="breadcrumb-item">View Feature</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Feature Overview</h4>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('admin.package-features.edit', $packageFeature->id) }}" class="btn btn-primary mr-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('admin.package-features.destroy', $packageFeature->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this feature?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">
                            {{-- Feature Title --}}
                            <div class="form-group">
                                <label class="font-weight-bold text-muted">Feature Description</label>
                                <div class="p-3 bg-light rounded font-weight-bold text-dark">
                                    {{ $packageFeature->feature }}
                                </div>
                            </div>

                            <div class="row mt-4">
                                {{-- Associated Package --}}
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold text-muted">Belongs to Package</label>
                                    <div>
                                        @if($packageFeature->package)
                                            <a href="{{ route('admin.packages.show', $packageFeature->package->id) }}" class="badge badge-info p-2">
                                                <i class="fas fa-box mr-1"></i> {{ $packageFeature->package->name }}
                                            </a>
                                        @else
                                            <span class="badge badge-secondary p-2">Unassigned</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-6 mb-3">
                                    <label class="font-weight-bold text-muted">Status</label>
                                    <div>
                                        @if($packageFeature->status === 'active')
                                            <span class="badge badge-success p-2"><i class="fas fa-check-circle mr-1"></i> Active</span>
                                        @else
                                            <span class="badge badge-danger p-2"><i class="fas fa-times-circle mr-1"></i> Inactive</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <hr>

                            {{-- Timestamps --}}
                            <div class="row text-muted small">
                                <div class="col-md-6">
                                    <i class="far fa-clock mr-1"></i> <strong>Created At:</strong> {{ $packageFeature->created_at?->format('Y-m-d H:i A') ?? 'N/A' }}
                                </div>
                                <div class="col-md-6">
                                    <i class="fas fa-history mr-1"></i> <strong>Last Updated:</strong> {{ $packageFeature->updated_at?->format('Y-m-d H:i A') ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Info Sidebar --}}
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Package Information</h4>
                        </div>
                        <div class="card-body">
                            @if($packageFeature->package)
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between px-0">
                                        Price
                                        <span class="font-weight-bold">${{ number_format($packageFeature->package->price, 2) }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between px-0">
                                        Type
                                        <span class="badge badge-primary text-uppercase">{{ $packageFeature->package->package_type }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between px-0">
                                        Duration
                                        <span>{{ $packageFeature->package->number_of_days }} Days</span>
                                    </li>
                                </ul>
                                <a href="{{ route('admin.packages.show', $packageFeature->package->id) }}" class="btn btn-outline-primary btn-block mt-3">
                                    View Full Package
                                </a>
                            @else
                                <p class="text-muted text-center mb-0">No parent package attached to this feature.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
