{{-- admin/listings/listing-schedule/edit.blade.php --}}
@extends('admin.dashboard.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Schedule</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('admin.listings.schedules.index', $listing->id) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <div class="section-body">
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="mb-1 text-muted">Editing Schedule For</h6>
                    <h5 class="mb-0">
                        <i class="fas fa-store text-primary mr-2"></i>
                        {{ $listing->title }}
                    </h5>
                </div>
            </div>

            <div class="card">
                <form action="{{ route('admin.listings.schedules.update', [$listing->id, $schedule->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Day <span class="text-danger">*</span></label>
                                    <select name="day" class="form-control @error('day') is-invalid @enderror">
                                        <option value="">Select Day</option>
                                        @foreach($days as $day)
                                            <option value="{{ $day }}" {{ old('day', $schedule->day) == $day ? 'selected' : '' }}>
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
                                        <option value="active" {{ old('status', $schedule->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $schedule->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
                                           value="{{ old('start_time', $schedule->start_time) }}">
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
                                           value="{{ old('end_time', $schedule->end_time) }}">
                                    @error('end_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Update Schedule
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Add any custom JavaScript here
            });
        </script>
    @endpush
@endsection
