@extends('admin.dashboard.layouts.master')

@section('dashboard_title','Create Location')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.locations.index') }}" class="btn btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <h1>Create Location</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.locations.index') }}">Locations</a>
                </div>
                <div class="breadcrumb-item">Create Location</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Create Location</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h4>Create Location</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.locations.store') }}" method="POST">

                                @csrf

                                <div class="row">

                                    {{-- Title --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Title <span class="text-danger">*</span></label>
                                            <input type="text" name="title"
                                                   class="form-control"
                                                   placeholder="Enter title"
                                                   value="{{ old('title') }}">

                                            @error('title')
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

                                    {{-- Notes --}}
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Notes</label>

                                            <textarea name="notes" rows="6" class="form-control"
                                                      placeholder="Enter notes">{{ old('notes') }}</textarea>

                                            @error('notes')
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
