@extends('layouts.learner')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/signin.css') }}">
@endsection

@section('content')

<div class="login-section">

    {{-- Illustration --}}
    <img src="{{ asset('images/sign-in-authentication.png') }}" class="left-peeking-image">

    <div class="container d-flex justify-content-center align-items-center">

        <div class="login-card text-center">

            <h3 class="mb-4 fw-bold">Sign In</h3>

            {{-- success message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" autocomplete="off">
                @csrf

                <div class="mb-3">
                    <input type="text"
                           name="email"
                           class="form-control"
                           placeholder="Enter your email"
                           required>
                </div>

                <div class="mb-2">
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Enter your password"
                           required>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3 small-link">
                    <div>
                        <input type="checkbox" name="remember"> Remember me
                    </div>

                    <a href="#">Forgot Password</a>
                </div>

                <button type="submit" class="btn btn-login w-100">
                    SIGN IN
                </button>

            </form>

            @if(session('error'))
                <p class="text-danger mt-3">{{ session('error') }}</p>
            @endif

            <div class="mt-4 small-link">
                <p>OR</p>
                <a href="{{ route('register') }}">Register my account</a>
            </div>

        </div>

    </div>

</div>

@endsection