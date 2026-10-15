@extends('admin.dashboard.layouts.master')

@section('dashboard_title', 'Clear Database')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-icon">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <h1>Clear Database</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">

                    {{-- Alerts --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body text-center">

                            <div class="mb-3">
                                <i class="fas fa-exclamation-triangle text-danger" style="font-size: 60px;"></i>
                            </div>

                            <h3 class="text-danger mb-3">Warning!</h3>

                            <p class="mb-3">
                                This action will <strong>permanently delete all data</strong> from the database.
                                <br>
                                <strong class="text-danger">This action cannot be undone!</strong>
                            </p>

                            <div class="alert alert-danger">
                                Are you sure you want to continue?
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-light mr-2">
                                    Cancel
                                </a>

                                {{-- Open Modal --}}
                                <button type="button"
                                        class="btn btn-danger"
                                        data-toggle="modal"
                                        data-target="#confirmDeleteModal">
                                    <i class="fas fa-trash mr-1"></i> Yes, Clear Database
                                </button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- Modal --}}
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Confirm Deletion
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-center">
                    <p class="mb-3">
                        Are you <strong>absolutely sure</strong> you want to clear the entire database?
                    </p>
                    <p class="text-danger font-weight-bold mb-0">
                        This action cannot be undone!
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">
                        No, Cancel
                    </button>

                    <form action="{{ route('admin.clear-database.destroy') }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash mr-1"></i> Yes, Clear Everything
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
