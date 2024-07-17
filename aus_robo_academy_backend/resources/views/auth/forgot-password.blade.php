<head><title>Forgot Password - Australian Robo Academy</title></head>
@include('backend.layouts.header')

<body class="hold-transition login-page" style="background-image: linear-gradient(#F8E177, #54B593);">
    <div class="login-box text-sm">

        <!-- /.login-logo -->
        <div class="card shadow">
            <div class="card-body login-card-body bg-gradient-light rounded">
                <div class="login-logo">
                    <a href="../../index2.html">
                        <img src="{{ URL::asset('/admin/dist/img/logo.png') }}" height="150" alt="BAB Logo" class="img-responsive">
                    </a>
                </div>
                <p class="login-box-msg text-dark tex-sm">
                    Forgot password? No problem. Just let us know your email address.
                </p>

                <x-auth-session-status class="mb-4 text-center text-success" :status="session('status')" />
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="input-group mb-3">
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-center" />
                    </div>

                    <div class="form-group">
                        <button class="btn btn-danger btn-block rounded-pill">
                            {{ __('Email Password Reset Link') }}
                        </button>
                    </div>
                </form>


            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ URL::asset('/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ URL::asset('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ URL::asset('/admin/dist/js/adminlte.min.js') }}"></script>
</body>

