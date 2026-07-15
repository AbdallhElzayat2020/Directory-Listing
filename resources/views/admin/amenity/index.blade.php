@extends('admin.dashboard.layouts.master')

@section('dashboard_title','Amenities')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Amenities</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.amenities.index') }}">Amenities</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">All Amenities</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Amenities</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.amenities.create') }}" class="btn btn-primary">Create <i class="fa-solid fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body">

                            {{$dataTable->table()}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endpush
