@extends('layouts.app')
@section('auth-content')
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 mx-auto mt-5">
                <div class="card radius-10">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <h4>Sign In</h4>
                            <p>Sign In to your account</p>
                        </div>
                        <form class="form-body row g-3" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="col-12 col-lg-12">
                                <div class="d-grid gap-2">
                                    {{-- <a href="javascript:;" class="btn border border-2 border-primary"><img
                                            src="assets/images/icons/google.png" width="20" alt=""><span
                                            class="ms-3 fw-500">Sign in with
                                            Google</span></a> --}}
                                </div>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="position-relative border-bottom my-3">
                                    <div class="position-absolute seperator-2 translate-middle-y">OR</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <x-input-basic type="email" label="Email" id="'email" name="email"
                                    placeholder="Your email" required />
                            </div>
                            <div class="col-12">
                                <x-input-basic type="password" label="Password" id="password" name="password"
                                    placeholder="Your password" required />
                            </div>
                            <div class="col-12 col-lg-6">
                                <x-input-checkbox label="Remember me" name="remember" id="remember" />
                            </div>
                            <div class="col-12 col-lg-6 text-end">
                                <a href="{{ route('password.request') }}">Forgot Password?</a>
                            </div>
                            <div class="col-12 col-lg-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Sign In</button>
                                </div>
                            </div>
                            <div class="col-12 col-lg-12 text-center mt-2">
                                <p class="mb-0">Don't have an account?
                                    <a href="{{ route('register') }}">Sign up</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
