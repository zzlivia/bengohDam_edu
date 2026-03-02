<!DOCTYPE html>
<html>
<head>
    <title>Register - Bengoh Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background:#f3f3f3; }
        .form-control {
            background:#dcd6c9;
            border:none;
            border-radius:10px;
            padding:12px;
        }
        .btn-register {
            background:#dcd6c9;
            border:none;
            border-radius:10px;
            padding:8px 20px;
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
        </ul>
    </div>
</nav>

<div class="container mt-5 text-center">
    <h3 class="mb-4">Register</h3>

    <form method="POST" action="{{ route('register') }}" style="max-width:400px;margin:auto;">
        @csrf

        <input type="text" name="name" class="form-control mb-3"
               placeholder="Enter your full name" required>

        <input type="email" name="email" class="form-control mb-3"
               placeholder="Enter your email" required>

        <input type="password" name="password" class="form-control mb-3"
               placeholder="Enter your password" required>

        <input type="password" name="password_confirmation" class="form-control mb-3"
               placeholder="Re-enter your password" required>

        <button type="submit" class="btn btn-register">REGISTER</button>
    </form>

    @if ($errors->any())
        <div class="text-danger mt-3">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <p class="mt-3">
        Already have an account?
        <a href="{{ route('login') }}">Sign in here</a>
    </p>
</div>

</body>
</html>