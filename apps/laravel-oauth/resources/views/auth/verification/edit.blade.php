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
                    <form action="{{ route('verification.update', ['unique_id' => $unique_id]) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="input-group mb-3">
                            <input type="number" name="otp" class="form-control @error('otp') is-invalid @enderror"
                                placeholder="Enter OTP" />
                            <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                            @error('otp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!--begin::Row-->
                        <div class="row">
                            <div class="col-8"></div>
                            <!-- /.col -->
                            <div class="col-4">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!--end::Row-->
                    </form>
                    <p class="mb-0">
                        <a href="#" class="text-center">Resend OTP</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </body>
@endsection

</html>
