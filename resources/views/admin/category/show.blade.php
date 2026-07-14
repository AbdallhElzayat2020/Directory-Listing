@extends('admin.dashboard.layouts.master')

@section('dashboard_title','Category Details')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>

            <h1>Category Details</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.categories.index') }}">Categories</a>
                </div>
                <div class="breadcrumb-item">Category Details</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Category Details</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h4>{{ $category->title }}</h4>

                            <div class="card-header-action">
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6 mb-4">
                                    <strong>Title</strong>
                                    <p>{{ $category->title }}</p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <strong>Slug</strong>
                                    <p>{{ $category->slug }}</p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <strong>Status</strong><br>

                                    @if($category->status == 'active')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </div>

                                <div class="col-md-6 mb-4">
                                    <strong>Show At Home</strong><br>

                                    @if($category->show_at_home == 'yes')
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-secondary">No</span>
                                    @endif
                                </div>

                                <div class="col-md-6 mb-4">
                                    <strong>Icon Image</strong>

                                    <div class="mt-2">
                                        @if($category->icon_image)
                                            <img src="{{ asset('categories/' . $category->icon_image) }}"
                                                 class="img-thumbnail" alt="{{ $category->title }}"
                                                 style="width:120px;height:120px;object-fit:cover;">
                                        @else
                                            <p>No Image</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <strong>Background Image</strong>

                                    <div class="mt-2">
                                        @if($category->bg_image)
                                            <img src="{{ asset('categories/' . $category->bg_image) }}"
                                                 class="img-thumbnail" alt="{{ $category->title }}"
                                                 style="width:220px;height:120px;object-fit:cover;">
                                        @else
                                            <p>No Image</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <strong>Description</strong>

                                    <div class="border rounded p-3 mt-2">
                                        {!! $category->description ?: '<span class="text-muted">No description available.</span>' !!}
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="card-footer text-right">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                                Back
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
