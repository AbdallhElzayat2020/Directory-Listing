@extends('admin.dashboard.layouts.master')

@section('dashboard_title', 'Features for ' . $package->name)

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.packages.show', $package->id) }}" class="btn btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <h1>Features: <b class="text-primary">{{ $package->name }}</b> </h1>

            <div class="section-header-button">
                <a href="{{ route('admin.packages.features.create', $package->id) }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Feature
                </a>
            </div>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.packages.index') }}">Packages</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.packages.show', $package->id) }}">{{ $package->name }}</a></div>
                <div class="breadcrumb-item">Features</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Manage Features</h2>
            <p class="section-lead">All custom features enabled for <strong>{{ $package->name }}</strong> package.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Feature List (Total: {{ $features->total() }})</h4>
                            <span class="badge badge-primary font-weight-bold p-2">${{ number_format($package->price, 2) }} / {{ $package->number_of_days }} Days</span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Feature Text</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($features as $feature)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="font-weight-bold">{{ $feature->feature }}</td>
                                            <td>
                                                @if($feature->status === 'active')
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $feature->created_at?->format('Y-m-d') }}</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-end">
                                                    {{-- Show --}}
                                                    <a href="{{ route('admin.package-features.show', $feature->id) }}"
                                                       class="btn btn-info btn-sm mr-1" title="Show">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    {{-- Edit --}}
                                                    <a href="{{ route('admin.package-features.edit', $feature->id) }}"
                                                       class="btn btn-primary btn-sm mr-1" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    {{-- Delete --}}
                                                    <form action="{{ route('admin.package-features.destroy', $feature->id) }}"
                                                          method="POST"
                                                          class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this feature?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">
                                                No features added to this package yet.
                                                <a href="{{ route('admin.packages.features.create', $package->id) }}">Add one now</a>.
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="float-right mt-3">
                                {{ $features->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
