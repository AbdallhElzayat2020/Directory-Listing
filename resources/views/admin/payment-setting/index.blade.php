@extends('admin.dashboard.layouts.master')

@section('dashboard_title', 'Payment Setting')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Payment Settings</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Payment Settings</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Payment Settings</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Payment Setting</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-2">
                                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#home4"
                                                role="tab" aria-controls="home" aria-selected="true">
                                                Paypal Setting
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4"
                                                role="tab" aria-controls="profile" aria-selected="false">
                                                Stripe Setting
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4"
                                                role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-12 col-md-10">
                                    <div class="tab-content no-padding" id="myTab2Content">

                                        @include('admin.payment-setting.sections.paypal-settings')

                                        @include('admin.payment-setting.sections.stripe-settings')

                                        <div class="tab-pane fade" id="contact4" role="tabpanel"
                                            aria-labelledby="contact-tab4">
                                            Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin
                                            ligula massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque
                                            fermentum, sem interdum molestie finibus, nulla diam varius leo, nec varius
                                            lectus elit id
                                            dolor. Nam malesuada orci non ornare vulputate. Ut ut sollicitudin magna.
                                            Vestibulum eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum
                                            augue ut luctus.
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
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Store active tab on tab change and adjust select2 if needed
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                var target = $(e.target).attr('href');
                sessionStorage.setItem('payment_setting_active_tab', target);

                if (jQuery().select2) {
                    $('.select2').select2({
                        width: '100%'
                    });
                }
            });

            // Restore active tab if previously saved
            var activeTab = sessionStorage.getItem('payment_setting_active_tab');
            if (activeTab && $(activeTab).length) {
                $('#myTab4 a[href="' + activeTab + '"]').tab('show');
            }
        });
    </script>
@endpush
