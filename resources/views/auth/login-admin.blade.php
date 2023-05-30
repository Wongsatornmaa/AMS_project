<!DOCTYPE html>
<html>
@php
$apartment = asset('image/apartment.png');
$padlock = asset('image/padlock.png');
$email = asset('image/email.png');
@endphp

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <!-- /.login-logo -->

        <!-- /.login-box-body -->
        <div class="card">
            <div class="row">
                <div class="col-sm-6">
                    <img src="{{ $apartment }} " alt="">
                </div>
                <div class="col-sm-6">
                    <div class="login-card">
                        <p class="login-box-msg">เข้าสู่ระบบ</p>

                        @if (session('message'))
                            <div class="row">
                                <div class="col">
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{ session('message') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form method="post" action="{{ route('loginAdmin') }}">
                            @csrf
                            <div class="col"><img class="image-login" src="{{ $email }}"
                                    alt="">User Name</div>
                            <div class="input-group mb-3">
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                                    class="form-control @error('email') is-invalid @enderror">
                                <div class="input-group-append">
                                    <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                                </div>
                                @error('email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col"><img class="image-login" src="{{ $padlock }}"
                                    alt="">Password</div>


                            <div class="input-group mb-3">
                                <input type="password" name="password" placeholder="Password"
                                    class="form-control @error('password') is-invalid @enderror">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror

                            </div>



                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
                            </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.login-card-body -->
    </div>



    </div>

    <!-- /.login-box -->

    <script src="{{ asset('js/app.js') }}" defer></script>

</body>

</html>
