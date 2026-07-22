@extends('admin.dashboard.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add New Schedule</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('admin.listings.schedules.index', $listing->id) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <div class="section-body">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-exclamation-circle mr-1"></i> Error!</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-exclamation-circle mr-1"></i> Error!</strong>
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="mb-1 text-muted">Adding Schedule For</h6>
                    <h5 class="mb-0">
                        <i class="fas fa-store text-primary mr-2"></i>
                        {{ $listing->title }}
                    </h5>
                </div>
            </div>

            <div class="card">
                <form action="{{ route('admin.listings.schedules.store', $listing->id) }}" method="POST">
                    @csrf

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Day <span class="text-danger">*</span></label>
                                    <select name="day" class="form-control @error('day') is-invalid @enderror">
                                        <option value="">Select Day</option>
                                        @foreach($days as $day)
                                            <option value="{{ $day }}" {{ old('day') == $day ? 'selected' : '' }}>
                                                {{ $day }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('day')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Time <span class="text-danger">*</span></label>
                                    <input type="time" name="start_time"
                                           class="form-control @error('start_time') is-invalid @enderror"
                                           value="{{ old('start_time') }}">
                                    @error('start_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Time <span class="text-danger">*</span></label>
                                    <input type="time" name="end_time"
                                           class="form-control @error('end_time') is-invalid @enderror"
                                           value="{{ old('end_time') }}">
                                    @error('end_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Save Schedule
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('js')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const startTime = document.querySelector('input[name="start_time"]');
            const endTime = document.querySelector('input[name="end_time"]');

            function validateTime() {
                if (startTime.value && endTime.value) {
                    if (startTime.value >= endTime.value) {
                        endTime.setCustomValidity('End time must be after start time');
                        endTime.classList.add('is-invalid');
                    } else {
                        endTime.setCustomValidity('');
                        endTime.classList.remove('is-invalid');
                    }
                }
            }

            startTime.addEventListener('change', validateTime);
            endTime.addEventListener('change', validateTime);
        });
    </script>
@endpush
