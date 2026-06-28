<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

    <link rel="stylesheet" href="{{ asset('assets/admin/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/modules/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/components.css') }}">

    <style>
        html,
        body{
            height:100%;
        }

        body{
            margin:0;
        }

        #app{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .section{
            width:100%;
            padding:0 !important;
            margin:0 !important;
        }

        .auth-wrapper{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .simple-footer{
            text-align:center;
            margin-top:20px;
        }
    </style>

</head>

<body>

<div id="app">

    <section class="section">

        <div class="container">

            <div class="row auth-wrapper">

                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-11">

                    <div class="card card-primary">

                        <div class="card-header">
                            <h4>Forgot Password</h4>
                        </div>

                        <div class="card-body">

                            @if(session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <p class="mb-4">
                                Forgot your password? No problem. Just let us know your email
                                address and we will email you a password reset link that will
                                allow you to choose a new one.
                            </p>

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="form-group">
                                    <label>Email</label>

                                    <input type="email"
                                           name="email"
                                           value="{{ old('email') }}"
                                           class="form-control @error('email') is-invalid @enderror">

                                    @error('email')
                                    <small class="text-danger d-block mt-2">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>

                                <div class="form-group mb-0">
                                    <button type="submit"
                                            class="btn btn-primary btn-lg btn-block">
                                        Email Password Reset Link
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
