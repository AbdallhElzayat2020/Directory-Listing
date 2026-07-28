@extends('admin.dashboard.layouts.master')

@section('dashboard_title', 'Amenity Details')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.amenities.index') }}" class="btn btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>

            <h1>Amenity Details</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.amenities.index') }}">Amenities</a>
                </div>
                <div class="breadcrumb-item">Show</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-header">
                            <h4>Amenity Information</h4>

                            <div class="card-header-action">
                                <a href="{{ route('admin.amenities.edit', $amenity->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="text-center mb-4">
                                <i class="{{ $amenity->icon }}" style="font-size:60px;color:#6777ef;"></i>
                            </div>

                            <table class="table table-bordered">
                                <tbody>

                                    <tr>
                                        <th width="35%">Title</th>
                                        <td>{{ $amenity->title }}</td>
                                    </tr>

                                    <tr>
                                        <th>Slug</th>
                                        <td>{{ $amenity->slug }}</td>
                                    </tr>

                                    <tr>
                                        <th>Icon Class</th>
                                        <td>
                                            <code>{{ $amenity->icon }}</code>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if ($amenity->status == 'active')
                                                <span class="badge badge-success">
                                                    Active
                                                </span>
                                            @else
                                                <span class="badge badge-danger">
                                                    Inactive
                                                </span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Created At</th>
                                        <td>{{ $amenity->created_at->format('d M Y - h:i A') }}</td>
                                    </tr>

                                    <tr>
                                        <th>Updated At</th>
                                        <td>{{ $amenity->updated_at->format('d M Y - h:i A') }}</td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>

                        <div class="card-footer text-right">
                            <a href="{{ route('admin.amenities.index') }}" class="btn btn-secondary">
                                Back
                            </a>

                            <a href="{{ route('admin.amenities.edit', $amenity->id) }}" class="btn btn-primary">
                                Edit
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
