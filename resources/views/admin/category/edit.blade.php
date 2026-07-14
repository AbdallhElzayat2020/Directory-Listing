@extends('admin.dashboard.layouts.master')

@section('dashboard_title','Edit Category')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <h1>Edit Category</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.categories.index') }}">Categories</a>
                </div>
                <div class="breadcrumb-item">Edit Category</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Category</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h4>Edit Category</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <div class="row">

                                    {{-- Title --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Title <span class="text-danger">*</span></label>
                                            <input type="text"
                                                   name="title"
                                                   class="form-control"
                                                   placeholder="Enter category title"
                                                   value="{{ old('title',$category->title) }}">

                                            @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Icon Image --}}
                                    <div class="col-lg-6">
                                        @if ($category->icon_image)
                                            <div class="mb-2">
                                                <img src="{{ asset('categories/'.$category->icon_image) }}" alt="Icon Image" width="100">
                                            </div>
                                        @endif
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
                                        @if ($category->bg_image)
                                            <div class="mb-2">
                                                <img src="{{ asset('categories/'.$category->bg_image) }}" alt="Background Image" width="100">
                                            </div>
                                        @endif
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
                                                <option value="active" @selected(old('status', $category->status) == 'active' )>
                                                    Active
                                                </option>
                                                <option value="inactive" @selected(old('status', $category->status) == 'inactive' )>
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
                                                <option value="yes" {{ old('show_at_home',$category->show_at_home) == 'yes' ? 'selected' : '' }}>
                                                    Yes
                                                </option>
                                                <option value="no" {{ old('show_at_home',$category->show_at_home) == 'no' ? 'selected' : '' }}>
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
                                                      placeholder="Enter category description">{{ old('description',$category->description) }}</textarea>

                                            @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">
                                        Update
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
