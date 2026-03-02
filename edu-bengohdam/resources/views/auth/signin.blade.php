<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In - Bengoh Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Bootstrap --}}
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
            <li class="nav-item mx-2"><a class="nav-link" href="#">Home</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="#">Courses</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="#">Community Stories</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="#">About the Dam</a></li>
            <li class="nav-item mx-2"><a class="nav-link text-primary" href="#">Register | Sign In</a></li>
        </ul>
    </div>
</nav>

{{-- login section --}}
<div class="container login-section d-flex align-items-center">

    <div class="row w-100 align-items-center">

        {{-- left illustration --}}
        <div class="col-md-6 text-center d-none d-md-block">
            <img src="{{ asset('images/login-illustration.png') }}" class="left-illustration">
        </div>

        {{-- Login Form --}}
        <div class="col-md-6 d-flex justify-content-center">
            <div class="login-card text-center">

                <h3 class="mb-4 fw-bold">Sign In</h3>

                <form method="POST" action="{{ url('/login') }}">
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
                    <a href="#">Register my account</a>
                </div>

            </div>
        </div>

    </div>
</div>

</body>
</html>