{{-- admin/listings/listing-schedule/index.blade.php --}}
@extends('admin.dashboard.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Manage Schedules</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('admin.listings.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Back to Listings
                </a>
            </div>
        </div>

        <div class="section-body">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1 text-muted">Managing Schedule For</h6>
                            <h5 class="mb-0">
                                <i class="fas fa-store text-primary mr-2"></i>
                                {{ $listing->title }}
                            </h5>
                        </div>
                        <a href="{{ route('admin.listings.schedules.create', $listing->id) }}" class="btn btn-success">
                            <i class="fas fa-plus mr-1"></i> Add New Schedule
                        </a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-md mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Day</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Status</th>
                                <th width="150">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($listing->schedules as $schedule)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $schedule->day }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $schedule->status == 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($schedule->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.listings.schedules.edit', [$listing->id, $schedule->id]) }}"
                                               class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- Delete form with onclick confirm --}}
                                            <form action="{{ route('admin.listings.schedules.destroy', [$listing->id, $schedule->id]) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('⚠️ Are you sure you want to delete this schedule?\n\nThis action cannot be undone!');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                        <br>
                                        No schedules have been added yet.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
