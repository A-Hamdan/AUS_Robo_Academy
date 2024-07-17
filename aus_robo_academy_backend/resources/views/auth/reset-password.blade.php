<head>
    <title>Reset Password - Australian Robo Academy</title>
</head>
@include('backend.layouts.header')

<body class="hold-transition login-page" style="background-image: linear-gradient(#F8E177, #54B593);">

    <div class="card shadow">
        <div class="card-body login-card-body bg-gradient-light rounded">
            <div class="login-logo">
                <a href="../../index2.html">
                    <img src="{{ URL::asset('/admin/dist/img/logo.png') }}" height="150" alt="BAB Logo"
                        class="img-responsive">
                </a>
            </div>
            <p class="login-box-msg text-dark tex-sm">
                Reset password.
            </p>
            <div class="card-body">
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <x-text-input id="email" class="form-control" type="email" name="email"
                            :value="old('email', $request->email)" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <x-text-input id="password" class="form-control" type="password" name="password" required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>

                        <x-text-input id="password_confirmation" class="form-control" type="password"
                            name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
