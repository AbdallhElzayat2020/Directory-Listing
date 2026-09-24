@extends('admin.dashboard.layouts.master')
@section('title', 'Inquiry Details')
@section('content')

    <div class="container-fluid">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">
                <i class="fas fa-envelope-open me-2"></i>Inquiry #{{ $inquiry->id }}
            </h4>
            <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i>Back
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-1"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-3">

            {{-- Sender Info --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-light">
                        <h6 class="mb-0"><i class="fas fa-user me-1"></i>Sender</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted d-block">Name</small>
                            <strong>{{ $inquiry->name }}</strong>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Email</small>
                            <a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Phone</small>
                            <a href="tel:{{ $inquiry->phone }}">{{ $inquiry->phone }}</a>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">Date</small>
                            <strong>{{ $inquiry->created_at->format('d M Y, h:i A') }}</strong>
                        </div>
                        @if($inquiry->sender)
                            <div class="mb-3">
                                <small class="text-muted d-block">Registered User</small>
                                <span class="badge bg-primary">{{ $inquiry->sender->name }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Message + Listing + Owner --}}
            <div class="col-lg-8">

                {{-- Message --}}
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-light d-flex justify-content-between">
                        <h6 class="mb-0"><i class="fas fa-envelope me-1"></i>Message</h6>
                        <span class="badge bg-success">Read</span>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted d-block">Subject</small>
                            <h5 class="mb-0">{{ $inquiry->subject }}</h5>
                        </div>
                        <hr>
                        <div style="white-space: pre-line;">{{ $inquiry->message ?? 'No message' }}</div>
                    </div>
                    <div class="card-footer bg-light">
                        <a href="mailto:{{ $inquiry->email }}?subject=Re: {{ $inquiry->subject }}"
                           class="btn btn-primary btn-sm">
                            <i class="fas fa-reply me-1"></i>Reply
                        </a>
                        <a href="tel:{{ $inquiry->phone }}" class="btn btn-success btn-sm">
                            <i class="fas fa-phone me-1"></i>Call
                        </a>
                        <form action="{{ route('admin.inquiries.destroy', $inquiry) }}"
                              method="POST" class="d-inline float-end"
                              onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Listing Info --}}
                @if($inquiry->listing)
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="fas fa-home me-1"></i>Related Listing</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('listings/' . $inquiry->listing->thumbnail_image) }}"
                                     alt="{{ $inquiry->listing->title }}"
                                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;"
                                     class="me-3">
                                <div class="flex-grow-1">
                                    <a href="{{ route('admin.listings.show', $inquiry->listing->slug) }}"
                                       target="_blank"
                                       class="text-decoration-none fw-bold fs-5">
                                        {{ $inquiry->listing->title }}
                                        <i class="fas fa-external-link-alt fa-sm ms-1"></i>
                                    </a>
                                    <div class="mt-1">
                                        <small class="text-muted">
                                            <i class="fas fa-map-marker-alt"></i>
                                            {{ $inquiry->listing->location->title ?? 'N/A' }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Owner Info --}}
                @if($inquiry->owner)
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="fas fa-crown me-1"></i>Listing Owner</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
                                    <i class="fas fa-user text-info fa-lg"></i>
                                </div>
                                <div>
                                    <strong>{{ $inquiry->owner->name }}</strong>
                                    <div><small class="text-muted">{{ $inquiry->owner->email }}</small></div>
                                    <span class="badge bg-{{ $inquiry->owner->user_type === 'admin' ? 'danger' : 'secondary' }}">
                                    {{ ucfirst($inquiry->owner->user_type) }}
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>

@endsection
