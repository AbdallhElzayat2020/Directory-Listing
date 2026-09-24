@extends('admin.dashboard.layouts.master')
@section('title', 'Contact Messages')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Contact Messages</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active">Contact Messages</div>
            </div>
        </div>

        <div class="section-body">

            {{-- Flash Messages --}}
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

            {{-- Stat Cards --}}
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Messages</h4>
                            </div>
                            <div class="card-body">
                                {{ $stats['total'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Unread</h4>
                            </div>
                            <div class="card-body">
                                {{ $stats['unread'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Read</h4>
                            </div>
                            <div class="card-body">
                                {{ $stats['read'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Today</h4>
                            </div>
                            <div class="card-body">
                                {{ $stats['today'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Filters & Search --}}
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.contacts.index') }}">
                        <div class="row align-items-center">
                            <div class="col-md-5 mb-2 mb-md-0">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="search" class="form-control"
                                           placeholder="Search by name, email, phone, message..."
                                           value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-4 mb-2 mb-md-0">
                                <select name="status" class="form-control selectric">
                                    <option value="">All Statuses</option>
                                    <option value="unread" @selected(request('status') === 'unread')>Unread Only</option>
                                    <option value="read" @selected(request('status') === 'read')>Read Only</option>
                                </select>
                            </div>
                            <div class="col-md-3 text-md-right">
                                <button type="submit" class="btn btn-primary mr-1">
                                    <i class="fas fa-filter mr-1"></i> Filter
                                </button>
                                <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-redo mr-1"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Table --}}
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>All Contact Messages</h4>
                    <span class="badge badge-primary">{{ $contacts->total() }} Total</span>
                </div>
                <div class="card-body p-0">
                    @if($contacts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;"></th>
                                        <th style="width: 60px;">#</th>
                                        <th>Sender</th>
                                        <th>Contact Info</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                        <th>Received Date</th>
                                        <th class="text-center" style="width: 160px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $contact)
                                        <tr class="{{ !$contact->is_read ? 'font-weight-bold table-warning' : '' }}" style="{{ !$contact->is_read ? 'background-color: #fff9e6;' : '' }}">
                                            <td>
                                                @if(!$contact->is_read)
                                                    <span class="badge badge-danger badge-pill" style="padding: 4px;" title="Unread Message">
                                                        <i class="fas fa-circle" style="font-size: 8px;"></i>
                                                    </span>
                                                @endif
                                            </td>
                                            <td>#{{ $contact->id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <figure class="avatar mr-2 {{ !$contact->is_read ? 'bg-primary text-white' : 'bg-light text-dark' }}">
                                                        <i class="fas fa-user"></i>
                                                    </figure>
                                                    <div>
                                                        <span class="d-block {{ !$contact->is_read ? 'text-primary font-weight-bold' : '' }}">
                                                            {{ $contact->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="mailto:{{ $contact->email }}" class="text-decoration-none">
                                                        <i class="fas fa-envelope fa-xs mr-1 text-muted"></i>{{ $contact->email }}
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href="tel:{{ $contact->phone }}" class="text-muted text-decoration-none">
                                                        <i class="fas fa-phone-alt fa-xs mr-1 text-muted"></i>{{ $contact->phone }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="d-inline-block text-truncate" style="max-width: 250px;" title="{{ $contact->message }}">
                                                    {{ Str::limit($contact->message, 60) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($contact->is_read)
                                                    <span class="badge badge-success">
                                                        <i class="fas fa-check mr-1"></i> Read
                                                    </span>
                                                @else
                                                    <span class="badge badge-warning text-dark font-weight-bold">
                                                        <i class="fas fa-envelope mr-1"></i> Unread
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div>{{ $contact->created_at->format('d M Y, h:i A') }}</div>
                                                <small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    {{-- View --}}
                                                    <a href="{{ route('admin.contacts.show', $contact) }}"
                                                       class="btn btn-primary btn-sm"
                                                       data-toggle="tooltip"
                                                       title="View Message Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    {{-- Toggle Read/Unread --}}
                                                    <form action="{{ route('admin.contacts.toggle-read', $contact) }}"
                                                          method="POST"
                                                          class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="btn btn-sm {{ $contact->is_read ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                                                data-toggle="tooltip"
                                                                title="{{ $contact->is_read ? 'Mark as Unread' : 'Mark as Read' }}">
                                                            <i class="fas {{ $contact->is_read ? 'fa-envelope' : 'fa-envelope-open' }}"></i>
                                                        </button>
                                                    </form>

                                                    {{-- Delete --}}
                                                    <form action="{{ route('admin.contacts.destroy', $contact) }}"
                                                          method="POST"
                                                          class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this message?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-danger btn-sm"
                                                                data-toggle="tooltip"
                                                                title="Delete Message">
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
                        <div class="card-footer text-right">
                            <div class="d-inline-block">
                                {{ $contacts->links() }}
                            </div>
                        </div>
                    @else
                        <div class="empty-state py-5 text-center">
                            <div class="empty-state-icon bg-light text-muted" style="width: 80px; height: 80px; line-height: 80px; border-radius: 50%; margin: 0 auto 20px; font-size: 32px;">
                                <i class="fas fa-inbox"></i>
                            </div>
                            <h2>No Messages Found</h2>
                            <p class="lead text-muted">
                                There are no contact messages matching your criteria.
                            </p>
                            @if(request()->filled('search') || request()->filled('status'))
                                <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-redo mr-1"></i> Clear Filters
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </section>
@endsection
