@extends('admin.dashboard.layouts.master')

@section('dashboard_title', 'Package Features')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Package Features</h1>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Package Features</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('admin.package-features.create') }}" class="btn btn-primary">Add New
                                Feature</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Package Name</th>
                                            <th>Feature</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($features as $feature)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><span class="badge badge-info">{{ $feature->package->name }}</span></td>
                                                <td>{{ $feature->feature }}</td>
                                                <td>
                                                    @if ($feature->status === 'active')
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        {{-- Show Button --}}
                                                        <a href="{{ route('admin.package-features.show', $feature->id) }}"
                                                            class="btn btn-info btn-sm mr-1" title="Show Details">
                                                            <i class="fas fa-eye"></i>
                                                        </a>

                                                        {{-- Edit Button --}}
                                                        <a href="{{ route('admin.package-features.edit', $feature->id) }}"
                                                            class="btn btn-primary btn-sm mr-1" title="Edit Feature">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>

                                                        {{-- Delete Form & Button --}}
                                                        <form id="delete-feature-{{ $feature->id }}"
                                                            action="{{ route('admin.package-features.destroy', $feature->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Are you sure you want to delete this feature?')">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                title="Delete Feature">
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
                            <div class="float-right">
                                {{ $features->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
