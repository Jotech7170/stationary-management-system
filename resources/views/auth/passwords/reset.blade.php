@extends('layouts.app')
@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth lock-full-bg">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-transparent text-left p-5 text-center">
                            <h3 class="text-light">{{ __('Reset Password') }}</h3>

                            <form method="POST" action="{{ route('password.update') }}" class="pt-5">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group">
                                    <label for="email" class="text-light">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror text-center text-light"
                                        name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                        autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password" class="text-light">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror  text-light"
                                        name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password-confirm"
                                        class="text-light">{{ __('Confirm Password') }}</label>

                                    <input id="password-confirm" type="password" class="form-control text-light"
                                        name="password_confirmation" required autocomplete="new-password">

                                </div>
                                <div class="mt-5">
                                    <button
                                        class="btn btn-block btn-success btn-lg font-weight-medium">{{ __('Reset Password') }}</button>
                                </div>

                            </form>




                            {{-- // --}}
                            {{-- <form class="pt-5">
                                <div class="form-group">
                                    <label for="examplePassword1">Password to unlock</label>
                                    <input type="password" class="form-control text-center" id="examplePassword1"
                                        placeholder="Password">
                                </div>
                                <div class="mt-5">
                                    <a class="btn btn-block btn-success btn-lg font-weight-medium"
                                        href="../../index.html">Unlock</a>
                                </div>
                                <div class="mt-3 text-center">
                                    <a href="#" class="auth-link text-white">Sign in using a different account</a>
                                </div>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

@endsection
