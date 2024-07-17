<head>
    <title>Login - Australian Robo Academy</title>
</head>
@include('backend.layouts.header')

<body class="hold-transition login-page" style="background-image: linear-gradient(#F8E177, #54B593);">
    <div class="login-box text-sm">
        <div class="card shadow">
            <div class="card-body login-card-body bg-gradient-light rounded">
                <div class="login-logo">
                    <a href="../../index2.html">
                        <img src="{{ URL::asset('/admin/dist/img/logo.png') }}" height="150" alt="BAB Logo"
                            class="img-responsive">
                    </a>
                </div>
                <p class="login-box-msg text-dark">Sign in to start your session</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Email" name="email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-danger rounded-pill btn-block text-bold">L O G I
                                N</button>
                        </div>
                    </div>
                </form>

                <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-info rounded-pill" data-toggle="modal"
                        data-target="#modal-student">
                        <i class="fas fa-school mr-1"></i> For Students
                    </a>
                </div>

                @include('backend.layouts.modals.student_login')

                <p class="mb-1">
                    @if (Route::has('password.request'))
                        <a class="text-dark" href="{{ route('password.request') }}">Forgot Password?</a>
                    @endif
                </p>
            </div>
        </div>
    </div>
    @include('backend.layouts.script')
</body>
