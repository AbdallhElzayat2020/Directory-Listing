@extends('admin.dashboard.layouts.master')

@section('dashboard_title', 'View Listing')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.listings.index') }}" class="btn btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <h1>View Listing</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('admin.listings.index') }}">Listings</a>
                </div>
                <div class="breadcrumb-item">View Listing</div>
            </div>
        </div>

        <div class="section-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="section-title mb-1">{{ $listing->title }}</h2>
                    <p class="section-lead m-0">Detailed overview and metrics for this listing.</p>
                </div>
                <div>
                    <a href="{{ route('admin.listings.edit', $listing->id) }}" class="btn btn-warning btn-icon icon-left shadow-sm">
                        <i class="fas fa-edit"></i> Edit Listing
                    </a>
                    <a href="{{ route('admin.listings.index') }}" class="btn btn-secondary btn-icon icon-left shadow-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>

            <div class="row">
                {{-- Quick Overview Sidebar --}}
                <div class="col-lg-4 col-md-10 col-12">
                    <div class="card author-box card-primary shadow-sm">
                        <div class="card-body">
                            <div class="author-box-avatar mb-3 text-center">
                                @if($listing->image)
                                    <img src="{{ asset('listings/' . $listing->image) }}" alt="Main Image" class="rounded shadow" style="width: 100%; max-height: 200px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 180px;">
                                        <span class="text-muted"><i class="fas fa-image fa-3x"></i></span>
                                    </div>
                                @endif
                            </div>
                            <div class="author-box-details">
                                <div class="author-box-name text-center mb-2">
                                    <h4 class="text-dark">{{ $listing->title }}</h4>
                                    <span class="text-muted small">{{ $listing->slug }}</span>
                                </div>
                                <hr>
                                <div class="row text-center mt-3">
                                    <div class="col-6 mb-3">
                                        <small class="text-muted d-block">Status</small>
                                        @if($listing->status == 'active')
                                            <span class="badge badge-success px-2 py-1 mt-1">Active</span>
                                        @else
                                            <span class="badge badge-danger px-2 py-1 mt-1">Inactive</span>
                                        @endif
                                    </div>
                                    <div class="col-6 mb-3">
                                        <small class="text-muted d-block">Verified</small>
                                        @if($listing->is_verified == 'yes')
                                            <span class="badge badge-success px-2 py-1 mt-1"><i class="fas fa-check-circle"></i> Yes</span>
                                        @else
                                            <span class="badge badge-warning px-2 py-1 mt-1"><i class="fas fa-clock"></i> Pending</span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Views</small>
                                        <span class="font-weight-bold text-primary mt-1 d-inline-block">
                                            <i class="fas fa-eye"></i> {{ number_format($listing->views) }}
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Featured</small>
                                        @if($listing->is_featured == 'yes')
                                            <span class="badge badge-warning px-2 py-1 mt-1"><i class="fas fa-star"></i> Featured</span>
                                        @else
                                            <span class="badge badge-light text-dark px-2 py-1 mt-1">No</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Detailed Tabs --}}
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="card shadow-sm">
                        <div class="card-header border-bottom-0 pb-0">
                            <ul class="nav nav-tabs card-header-tabs" id="listingTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basic" role="tab">
                                        <i class="fas fa-info-circle mr-1"></i> Basic Info
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab">
                                        <i class="fas fa-address-card mr-1"></i> Contact & Social
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="amenities-tab" data-toggle="tab" href="#amenities" role="tab">
                                        <i class="fas fa-star mr-1"></i> Amenities & Media
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="system-tab" data-toggle="tab" href="#system" role="tab">
                                        <i class="fas fa-cog mr-1"></i> System & SEO
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="listingTabContent">

                                {{-- Tab 1: Basic Info --}}
                                <div class="tab-pane fade show active" id="basic" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted font-weight-bold">Category</label>
                                            <h5><span class="badge badge-primary px-3 py-2">{{ $listing->category->title ?? 'N/A' }}</span></h5>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted font-weight-bold">Location</label>
                                            <h5><span class="badge badge-info px-3 py-2">{{ $listing->location->title ?? 'N/A' }}</span></h5>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted font-weight-bold">Package</label>
                                            <div>
                                                @if($listing->package)
                                                    <span class="badge badge-success px-3 py-2">{{ $listing->package->title ?? 'N/A' }}</span>
                                                @else
                                                    <span class="text-muted">No package selected</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted font-weight-bold">Expiry Date</label>
                                            <div class="p-2 border rounded bg-light d-flex align-items-center justify-content-between">
                                                <span><i class="far fa-calendar-alt text-danger mr-1"></i> {{ \Carbon\Carbon::parse($listing->expired_date)->format('d M, Y') }}</span>
                                                @if(\Carbon\Carbon::parse($listing->expired_date)->isPast())
                                                    <span class="badge badge-danger">Expired</span>
                                                @else
                                                    <span class="badge badge-success">Active</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="text-muted font-weight-bold">Description</label>
                                            <div class="p-3 border rounded bg-light style-description">
                                                {!! $listing->description !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tab 2: Contact & Social --}}
                                <div class="tab-pane fade" id="contact" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted font-weight-bold">Phone</label>
                                            <div class="p-2 border rounded bg-light">
                                                <i class="fas fa-phone text-primary mr-2"></i>
                                                <a href="tel:{{ $listing->phone }}" class="text-dark font-weight-600">{{ $listing->phone ?? 'N/A' }}</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted font-weight-bold">Email</label>
                                            <div class="p-2 border rounded bg-light">
                                                <i class="fas fa-envelope text-primary mr-2"></i>
                                                <a href="mailto:{{ $listing->email }}" class="text-dark font-weight-600">{{ $listing->email ?? 'N/A' }}</a>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="text-muted font-weight-bold">Website</label>
                                            <div class="p-2 border rounded bg-light">
                                                @if($listing->website)
                                                    <i class="fas fa-globe text-primary mr-2"></i>
                                                    <a href="{{ $listing->website }}" target="_blank">{{ $listing->website }}</a>
                                                @else
                                                    <span class="text-muted">Not provided</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="text-muted font-weight-bold">Address</label>
                                            <div class="p-2 border rounded bg-light">
                                                <i class="fas fa-map-marker-alt text-danger mr-2"></i> <span class="font-weight-600">{{ $listing->address }}</span>
                                            </div>
                                        </div>

                                        <div class="col-12"><hr class="my-3"></div>

                                        @php
                                            $socialLinks = [
                                                'facebook' => ['icon' => 'fab fa-facebook', 'color' => 'primary', 'label' => 'Facebook'],
                                                'x' => ['icon' => 'fab fa-twitter', 'color' => 'info', 'label' => 'X (Twitter)'],
                                                'instagram' => ['icon' => 'fab fa-instagram', 'color' => 'danger', 'label' => 'Instagram'],
                                                'linkedin' => ['icon' => 'fab fa-linkedin', 'color' => 'primary', 'label' => 'LinkedIn'],
                                                'whatsapp' => ['icon' => 'fab fa-whatsapp', 'color' => 'success', 'label' => 'WhatsApp'],
                                            ];
                                        @endphp

                                        @foreach($socialLinks as $key => $social)
                                            @php $field = $key . '_link'; @endphp
                                            <div class="col-md-6 mb-3">
                                                <label class="text-muted font-weight-bold">{{ $social['label'] }}</label>
                                                <div class="p-2 border rounded bg-light text-truncate">
                                                    @if($listing->$field)
                                                        <i class="{{ $social['icon'] }} text-{{ $social['color'] }} mr-2"></i>
                                                        <a href="{{ $listing->$field }}" target="_blank">{{ $listing->$field }}</a>
                                                    @else
                                                        <span class="text-muted small">Not provided</span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted font-weight-bold">Google Map Location</label>
                                            <div class="p-2 border rounded bg-light">
                                                @if($listing->google_map_embed_code)
                                                    <i class="fas fa-map text-danger mr-2"></i>
                                                    <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#mapModal">
                                                        <i class="fas fa-eye"></i> Open Interactive Map
                                                    </button>
                                                @else
                                                    <span class="text-muted">Not provided</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tab 3: Amenities & Media --}}
                                <div class="tab-pane fade" id="amenities" role="tabpanel">
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <label class="text-muted font-weight-bold mb-2 d-block">Selected Amenities</label>
                                            @if($listing->amenities->count() > 0)
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach($listing->amenities as $amenity)
                                                        <span class="badge badge-light border text-dark p-2 m-1 rounded shadow-sm">
                                                            <i class="fas fa-check-circle text-success mr-1"></i> {{ $amenity->title }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="p-3 border rounded bg-light text-muted text-center">No amenities selected</div>
                                            @endif
                                        </div>

                                        <div class="col-12"><hr></div>

                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted font-weight-bold d-block mb-2">Thumbnail Image</label>
                                            @if($listing->thumbnail_image)
                                                <img src="{{ asset('listings/' . $listing->thumbnail_image) }}" alt="Thumbnail Image" class="img-thumbnail shadow-sm" style="max-height: 150px; width: auto; object-fit: cover;">
                                            @else
                                                <span class="text-muted d-block p-3 border rounded bg-light text-center">No thumbnail uploaded</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Tab 4: System & SEO --}}
                                <div class="tab-pane fade" id="system" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted font-weight-bold">SEO Title</label>
                                            <p class="p-2 border rounded bg-light text-dark font-weight-600">{{ $listing->seo_title ?? 'Not set' }}</p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="text-muted font-weight-bold">SEO Description</label>
                                            <p class="p-2 border rounded bg-light text-dark">{{ $listing->seo_description ?? 'Not set' }}</p>
                                        </div>

                                        <div class="col-12"><hr class="my-2"></div>

                                        <div class="col-md-4 mb-3">
                                            <label class="text-muted font-weight-bold">Created By</label>
                                            <p class="p-2 border rounded bg-light mb-0">
                                                <i class="fas fa-user text-primary mr-1"></i> {{ $listing->user->name ?? 'N/A' }}
                                            </p>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="text-muted font-weight-bold">Created At</label>
                                            <p class="p-2 border rounded bg-light mb-0">
                                                <i class="far fa-calendar-alt text-muted mr-1"></i> {{ $listing->created_at->format('d M, Y h:i A') }}
                                            </p>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="text-muted font-weight-bold">Last Updated</label>
                                            <p class="p-2 border rounded bg-light mb-0">
                                                <i class="fas fa-history text-muted mr-1"></i> {{ $listing->updated_at->format('d M, Y h:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Google Map Modal --}}
    @if($listing->google_map_embed_code)
        <div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-map-marked-alt text-danger"></i> Location Map</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0 embed-responsive embed-responsive-16by9">
                        {!! $listing->google_map_embed_code !!}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('css')
    <style>
        .nav-tabs.card-header-tabs .nav-link.active {
            border-bottom-color: #fff !important;
            font-weight: 600;
        }
        .style-description {
            max-height: 250px;
            overflow-y: auto;
        }
        .font-weight-600 {
            font-weight: 600;
        }
        iframe {
            width: 100% !important;
            height: 100% !important;
            border: 0;
        }
        .gap-2 {
            gap: 0.5rem;
        }
    </style>
@endpush
