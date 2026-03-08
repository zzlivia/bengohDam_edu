<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In - Bengoh Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: white;
        }

        .login-section {
            height: 90vh;
        }

        .login-card {
            background: transparent;
            border: none;
            width: 100%;
            max-width: 400px;
        }

        .form-control {
            background-color: #dcd6c9;
            border: none;
            border-radius: 10px;
            padding: 12px;
        }

        .form-control:focus {
            box-shadow: none;
            background-color: #dcd6c9;
        }

        .btn-login {
            background-color: #dcd6c9;
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-weight: bold;
        }

        .btn-login:hover {
            background-color: #cfc8bb;
        }

        .left-illustration {
            max-width: 400px;
        }

        .small-link {
            font-size: 14px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg px-4">
    <a class="navbar-brand fw-bold" href="#">Bengoh Academy</a>
    <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
            <li class="nav-item mx-2"><a class="nav-link active" href="/homepage">Home</a></li>
            <li class="nav-item mx-2"><a class="nav-link active" href="/courses">Courses</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="#">Community Stories</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="#">About the Dam</a></li>
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Language </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="#">English</a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">Bahasa Melayu</a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">Iban</a>
                </li>
            </ul>
            <li class="nav-item mx-2 d-flex align-items-center">
                @auth
                    {{-- Show this if user is logged in --}}
                    <span class="nav-link">Hi, {{ auth()->user()->userName }}</span>
                @else
                    {{-- Split into two distinct clickable links --}}
                    <a class="nav-link text-primary fw-bold p-0" href="{{ route('register') }}">Register</a>
                    <span class="text-muted mx-1">|</span>
                    <a class="nav-link text-primary fw-bold p-0" href="{{ route('login') }}">Sign In</a>
                @endauth
            </li>
        </ul>
    </div>
</nav>

{{-- login section --}}
<div class="container login-section d-flex align-items-center">

    <div class="row w-100 align-items-center">

        {{-- left illustration --}}
        <div class="col-md-6 text-center d-none d-md-block">
            <img src="{{ asset('images/sign-in-authentication.png') }}" class="left-illustration">
        </div>

        {{-- sign in form --}}
        <div class="col-md-6 d-flex justify-content-center">
            <div class="login-card text-center">
                <h3 class="mb-4 fw-bold">Sign In</h3>
                {{-- alert of successfull after register --}}
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <input type="text" name="email" class="form-control"
                               placeholder="Enter your email" required>
                    </div>

                    <div class="mb-2">
                        <input type="password" name="password" class="form-control"
                               placeholder="Enter your password" required>
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
</div>

</body>
</html>