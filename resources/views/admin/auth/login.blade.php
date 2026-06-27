<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login Admin</title>

    <link rel="stylesheet" href="{{ asset('assets/admin/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/modules/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/components.css') }}">
</head>

<body>

<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

                    <div class="login-brand">
                        <img src="{{ asset('assets/admin/assets/img/stisla-fill.svg') }}"
                             alt="logo"
                             width="100"
                             class="shadow-light rounded-circle">
                    </div>

                    <div class="card card-primary">

                        <div class="card-header">
                            <h4>Login</h4>
                        </div>

                        <div class="card-body">

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group">
                                    <label>Email</label>

                                    <input
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        autofocus>

                                    @error('email')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>

                                <div class="form-group">

                                    <div class="d-block">
                                        <label>Password</label>

                                        <div class="float-right">
                                            <a href="{{ route('admin.password.request') }}" class="text-small">
                                                Forgot Password?
                                            </a>
                                        </div>
                                    </div>

                                    <input
                                        type="password"
                                        name="password"
                                        class="form-control @error('password') is-invalid @enderror">

                                    @error('password')
                                    <small class="text-danger d-block mt-1">
                                        {{ $message }}
                                    </small>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                               class="custom-control-input"
                                               id="remember"
                                               name="remember">

                                        <label class="custom-control-label" for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary btn-lg btn-block">
                                        Login
                                    </button>
                                </div>

                            </form>

                        </div>

                    </div>

                    <div class="simple-footer">
                        Copyright &copy;
                        <a href="https://abdallh-elzayat.me" target="_blank">
                            Abdullah Elzayat
                        </a>
                        {{ date('Y') }}
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

@include('admin.dashboard.layouts.scripts')

</body>
</html>
