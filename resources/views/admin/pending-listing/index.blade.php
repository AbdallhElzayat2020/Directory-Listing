@extends('admin.dashboard.layouts.master')

@section('dashboard_title','All Pending Listings')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>All Pending Listings</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="javascript:void(0)">All Pending Listings</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Pending Listings</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Pending Listings</h4>
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


    <script>
        $(document).ready(function () {

            $('body').on('change', '.approve', function () {

                let id = $(this).data('id');

                let value = $(this).val();

                $.ajax({
                    method: 'POST',
                    url: '{{route('admin.listings.update-status')}}',
                    data: {
                        _token: "{{csrf_token()}}",
                        id: id,
                        value: value,
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            alert(response.message);

                        } else {
                            alert(response.message)
                        }
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            });
        });
    </script>

@endpush
