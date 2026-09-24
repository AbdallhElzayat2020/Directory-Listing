@extends('admin.dashboard.layouts.master')
@section('title', 'Contact Message Details')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Message Details #{{ $contact->id }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Contact Messages</a></div>
                <div class="breadcrumb-item active">Details</div>
            </div>
        </div>

        <div class="section-body">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="row">
                {{-- Sender Information --}}
                <div class="col-lg-4 col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-user mr-2"></i> Sender Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <figure class="avatar avatar-xl bg-primary text-white mb-2">
                                    <i class="fas fa-user fa-2x"></i>
                                </figure>
                                <h5 class="mt-2 mb-0">{{ $contact->name }}</h5>
                                <small class="text-muted">Visitor</small>
                            </div>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span class="text-muted"><i class="fas fa-envelope mr-1"></i> Email:</span>
                                    <a href="mailto:{{ $contact->email }}" class="font-weight-bold">{{ $contact->email }}</a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span class="text-muted"><i class="fas fa-phone-alt mr-1"></i> Phone:</span>
                                    <a href="tel:{{ $contact->phone }}" class="font-weight-bold">{{ $contact->phone }}</a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span class="text-muted"><i class="far fa-clock mr-1"></i> Received At:</span>
                                    <span class="font-weight-bold text-dark">{{ $contact->created_at->format('d M Y, h:i A') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span class="text-muted"><i class="fas fa-info-circle mr-1"></i> Status:</span>
                                    @if($contact->is_read)
                                        <span class="badge badge-success"><i class="fas fa-check mr-1"></i> Read</span>
                                    @else
                                        <span class="badge badge-warning text-dark font-weight-bold"><i class="fas fa-envelope mr-1"></i> Unread</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Message Content & Actions --}}
                <div class="col-lg-8 col-md-7">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4><i class="fas fa-comment-dots mr-2"></i> Message Body</h4>
                            <span class="text-muted"><i class="far fa-calendar-alt mr-1"></i> {{ $contact->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="card-body">
                            <div class="p-3 bg-light rounded" style="white-space: pre-line; line-height: 1.8; font-size: 15px; color: #333; min-height: 180px;">
                                {{ $contact->message }}
                            </div>
                        </div>
                        <div class="card-footer bg-whitesmoke d-flex flex-wrap justify-content-between align-items-center" style="gap: 8px;">
                            <div>
                                {{-- Reply via Email --}}
                                <a href="mailto:{{ $contact->email }}?subject=Regarding your message on {{ config('app.name') }}"
                                   class="btn btn-primary mr-1">
                                    <i class="fas fa-reply mr-1"></i> Reply via Email
                                </a>

                                {{-- Call Phone --}}
                                <a href="tel:{{ $contact->phone }}" class="btn btn-info mr-1">
                                    <i class="fas fa-phone mr-1"></i> Call
                                </a>

                                {{-- Toggle Read / Unread --}}
                                <form action="{{ route('admin.contacts.toggle-read', $contact) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn {{ $contact->is_read ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                        <i class="fas {{ $contact->is_read ? 'fa-envelope' : 'fa-envelope-open' }} mr-1"></i>
                                        {{ $contact->is_read ? 'Mark as Unread' : 'Mark as Read' }}
                                    </button>
                                </form>
                            </div>

                            <div>
                                {{-- Delete --}}
                                <form action="{{ route('admin.contacts.destroy', $contact) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this contact message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
