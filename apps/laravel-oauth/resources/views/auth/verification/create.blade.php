@extends('layouts.auth')

@section('content')

    <body class="login-page bg-body-secondary">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ route('verification.create') }}"><b>Verification</b> Account</a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    @if (session('failed'))
                        <div class="alert alert-danger">{{ session('failed') }}</div>
                    @endif
                    <p class="login-box-msg">Please verify your accout!</p>
                    <form action="{{ route('verification.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="type" value="register">
                        <button type="submit" class="btn btn-sm btn-primary">Send OTP to your email</button>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </body>
@endsection

</html>
