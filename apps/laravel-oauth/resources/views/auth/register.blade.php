@extends('layouts.auth')

@section('content')

    <body class="register-page bg-body-secondary">
        <div class="register-box">
            <div class="register-logo">
                <a href="../index2.html"><b>Admin</b>LTE</a>
            </div>
            <!-- /.register-logo -->
            <div class="card">
                <div class="card-body register-card-body">
                    <p class="register-box-msg">Register a new user</p>
                    <form action="{{ route('register.post') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="Name" value="{{ old('name') }}" />
                            <div class="input-group-text"><span class="bi bi-person"></span></div>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                placeholder="Email" value="{{ old('email') }}" />
                            <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Password" />
                            <div class="input-group-text show-password"><span class="bi bi-lock-fill"
                                    id="password-icon"></span></div>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="confirm-password" name="password_confirmation" placeholder="Confirm Password" />
                            <div class="input-group-text show-confirm-password"><span class="bi bi-lock-fill"
                                    id="confirm-password-icon"></span></div>
                            @error('confirm_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!--begin::Row-->
                        <div class="row">
                            <div class="col-8">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree to the <a href="#">terms</a>
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Sign Up</button>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!--end::Row-->
                    </form>
                    <div class="social-auth-links text-center mb-3 d-grid gap-2">
                        <p>- OR -</p>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-facebook me-2"></i> Sign up using Facebook
                        </a>
                        <a href="#" class="btn btn-danger">
                            <i class="bi bi-google me-2"></i> Sign up using Google+
                        </a>
                    </div>
                    <!-- /.social-auth-links -->
                    <p class="mb-0">
                        <a href="{{ route('login') }}" class="text-center"> I already have a membership </a>
                    </p>
                </div>
                <!-- /.register-card-body -->
            </div>
        </div>

        <script>
            // Password Toggle
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

            // Confirm Password Toggle
            document.addEventListener('DOMContentLoaded', () => {
                const passwordToggle = document.querySelector('.show-confirm-password');
                const passwordInput = document.getElementById('confirm-password');
                const passwordIcon = document.getElementById('confirm-password-icon');

                if (passwordToggle) {
                    passwordToggle.addEventListener('click', function() {
                        const isPassword = passwordInput.type === 'password';
                        passwordInput.type = isPassword ? 'text' : 'password';

                        if (isPassword) {
                            Icon.classList.replace('bi-lock-fill', 'bi-unlock-fill');
                        } else {
                            Icon.classList.replace('bi-unlock-fill', 'bi-lock-fill');
                        }
                    });
                }
            });
        </script>
    </body>
@endsection
