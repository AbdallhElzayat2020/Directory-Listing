@extends('admin.dashboard.layouts.master')

@section('dashboard_title','Location Details')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.locations.index') }}" class="btn btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>

            <h1>Location Details</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.locations.index') }}">Locations</a>
                </div>
                <div class="breadcrumb-item">Location Details</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Location Details</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h4>{{ $location->title }}</h4>

                            <div class="card-header-action">
                                <a href="{{ route('admin.locations.edit', $location->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6 mb-4">
                                    <strong>Title</strong>
                                    <p>{{ $location->title }}</p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <strong>Slug</strong>
                                    <p>{{ $location->slug }}</p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <strong>Status</strong><br>

                                    @if($location->status == 'active')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </div>

                                <div class="col-md-6 mb-4">
                                    <strong>Show At Home</strong><br>

                                    @if($location->show_at_home == 'yes')
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-danger">No</span>
                                    @endif
                                </div>



                                <div class="col-12">
                                    <strong>Notes</strong>

                                    <div class="border rounded p-3 mt-2">
                                        {!! $location->notes ?: '<span class="text-muted">No notes available.</span>' !!}
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="card-footer text-right">
                            <a href="{{ route('admin.locations.index') }}" class="btn btn-secondary">
                                Back
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
