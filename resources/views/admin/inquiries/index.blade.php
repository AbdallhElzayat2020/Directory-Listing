@extends('admin.dashboard.layouts.master')
@section('title', 'All Inquiries')
@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">
                <i class="fas fa-envelope me-2"></i>All Inquiries
            </h4>
            <span class="badge bg-primary">{{ $stats['total'] }} Total</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-1"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Stats Cards --}}
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                            <i class="fas fa-envelope text-primary fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">{{ $stats['total'] }}</h5>
                            <small class="text-muted">Total</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
                            <i class="fas fa-envelope-open text-warning fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">{{ $stats['unread'] }}</h5>
                            <small class="text-muted">Unread</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                            <i class="fas fa-envelope-circle-check text-success fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">{{ $stats['read'] }}</h5>
                            <small class="text-muted">Read</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
                            <i class="fas fa-calendar-day text-info fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">{{ $stats['today'] }}</h5>
                            <small class="text-muted">Today</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.inquiries.index') }}" class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control"
                               placeholder="Search name, email, phone..."
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="unread" @selected(request('status') == 'unread')>Unread</option>
                            <option value="read" @selected(request('status') == 'read')>Read</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="listing_id" class="form-select">
                            <option value="">All Listings</option>
                            @foreach($listings as $listing)
                                <option value="{{ $listing->id }}" @selected(request('listing_id') == $listing->id)>
                                    {{ Str::limit($listing->title, 40) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-1"></i>Filter
                        </button>
                        <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-redo me-1"></i>Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Table --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                @if($inquiries->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                            <tr>
                                <th width="40"></th>
                                <th>ID</th>
                                <th>Sender</th>
                                <th>Subject</th>
                                <th>Listing</th>
                                <th>Owner</th>
                                <th>Date</th>
                                <th width="120">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($inquiries as $inquiry)
                                <tr class="{{ !$inquiry->is_read ? 'fw-bold bg-light' : '' }}">
                                    <td>
                                        @if(!$inquiry->is_read)
                                            <span class="badge bg-primary rounded-circle p-1"
                                                  style="width: 10px; height: 10px; display: inline-block;">
                                            </span>
                                        @endif
                                    </td>
                                    <td>#{{ $inquiry->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-secondary bg-opacity-10 rounded-circle p-2 me-2">
                                                <i class="fas fa-user text-secondary"></i>
                                            </div>
                                            <div>
                                                <div>{{ $inquiry->name }}</div>
                                                <small class="text-muted">{{ $inquiry->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ Str::limit($inquiry->subject, 30) }}</td>
                                    <td>
                                        @if($inquiry->listing)
                                            <a href="{{ route('listing-details', $inquiry->listing->slug) }}"
                                               target="_blank"
                                               class="text-decoration-none">
                                                {{ Str::limit($inquiry->listing->title, 25) }}
                                                <i class="fas fa-external-link-alt fa-xs ms-1"></i>
                                            </a>
                                        @else
                                            <span class="badge bg-danger">Deleted</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($inquiry->owner)
                                            <span class="badge bg-info">{{ $inquiry->owner->name }}</span>
                                        @else
                                            <span class="badge bg-secondary">Unknown</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small>{{ $inquiry->created_at->format('d M Y') }}</small><br>
                                        <small class="text-muted">{{ $inquiry->created_at->diffForHumans() }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.inquiries.show', $inquiry) }}"
                                               class="btn btn-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.inquiries.destroy', $inquiry) }}"
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="p-3">
                        {{ $inquiries->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No Inquiries Found</h5>
                        <p class="text-muted mb-0">No inquiries match your filters.</p>
                    </div>
                @endif
            </div>
        </div>

    </div>

@endsection
