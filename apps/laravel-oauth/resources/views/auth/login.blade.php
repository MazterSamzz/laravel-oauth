@extends('layouts.auth')

@section('content')

    <body class="login-page bg-body-secondary">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ route('login') }}"><b>Belajar</b> Auth</a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    @if (session('failed'))
                        <div class="alert alert-danger">{{ session('failed') }}</div>
                    @endif
                    <p class="login-box-msg">Sign in to start your session</p>
                    <form action="{{ route('login.post') }}" method="post">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Email" />
                            <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <input id="password" type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Password" />
                            <div class="input-group-text show-password" style="cursor: pointer">
                                <span class="bi bi-lock-fill" id="password-icon"></span>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!--begin::Row-->
                        <div class="row">
                            <div class="col-8">
                                <div class="form-check">
                                    <input name="remember" class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault" />
                                    <label class="form-check-label" for="flexCheckDefault"> Remember Me </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Sign In</button>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!--end::Row-->
                    </form>
                    <div class="social-auth-links text-center mb-3 d-grid gap-2">
                        <p>- OR -</p>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-facebook me-2"></i> Sign in using Facebook
                        </a>
                        <a href="#" class="btn btn-danger">
                            <i class="bi bi-google me-2"></i> Sign in using Google+
                        </a>
                    </div>
                    <!-- /.social-auth-links -->
                    <p class="mb-1"><a href="forgot-password.html">I forgot my password</a></p>
                    <p class="mb-0">
                        <a href="{{ route('register') }}" class="text-center"> Register a new membership </a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>

        {{-- Password Toggle --}}
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const passwordToggle = document.querySelector('.show-password');
                const passwordInput = document.getElementById('password');
                const passwordIcon = document.getElementById('password-icon');

                if (passwordToggle) {
                    passwordToggle.addEventListener('click', function() {
                        const isPassword = passwordInput.type === 'password';
                        passwordInput.type = isPassword ? 'text' : 'password';

                        if (isPassword) {
                            passwordIcon.classList.replace('bi-lock-fill', 'bi-unlock-fill');
                        } else {
                            passwordIcon.classList.replace('bi-unlock-fill', 'bi-lock-fill');
                        }
                    });
                }
            });
        </script>
    </body>
@endsection

</html>
