@extends('admin.dashboard.layouts.master')

@section('dashboard_title', 'Setting')

@section('content')
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Settings</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Settings</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Settings</h2>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Settings</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-2">
                                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#home4"
                                               role="tab" aria-controls="home" aria-selected="true">
                                                General Settings
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4"
                                               role="tab" aria-controls="profile" aria-selected="false">
                                                Logo & Favicon Settings
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4"
                                               role="tab" aria-controls="contact" aria-selected="false">
                                                Appearance Settings
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-12 col-md-10">
                                    <div class="tab-content no-padding" id="myTab2Content">
                                        <div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">


                                            @include('admin.setting.sections.general-settings')

                                        </div>
                                        <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">

                                            @include('admin.setting.sections.logo-favicon-settings')

                                        </div>
                                        <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">

                                            @include('admin.setting.sections.appearance-settings')

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
