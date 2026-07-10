@extends('admin.dashboard.layouts.master')

@section('dashboard_title','Hero Section')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Hero Section</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.hero.index') }}">Hero Section</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Hero Section</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Hero Section</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.hero.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <!-- Banner Section -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Current Banner</label>
                                            <div class="mb-3">
                                                @if($banner->bg_image)
                                                    <img src="{{ asset('uploads/' . $banner->bg_image) }}"
                                                         alt="Current Banner"
                                                         style="width: 120px; height: 120px; object-fit: cover; border-radius: 10px; border: 2px solid #ddd;">
                                                @else
                                                    <div class="text-muted">No banner uploaded</div>
                                                @endif
                                            </div>
                                            <label for="banner-input">Change Banner</label>
                                            <input type="file"
                                                   name="bg_image"
                                                   id="bg_image-input"
                                                   class="form-control"
                                                   accept="image/*">
                                            @error('bg_image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="row my-4">
                                    {{-- Title --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="title">Title <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   id="title"
                                                   placeholder="Please enter the title"
                                                   name="title"
                                                   value="{{ old('title', $banner->title) }}"
                                                   class="form-control">
                                            @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    {{-- Description --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text"
                                                   id="description"
                                                   placeholder="Please enter the description"
                                                   name="description"
                                                   value="{{ old('description', $banner->description) }}"
                                                   class="form-control">
                                            @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
