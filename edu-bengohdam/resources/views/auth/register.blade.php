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