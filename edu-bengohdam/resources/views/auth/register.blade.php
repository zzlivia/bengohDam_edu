<!DOCTYPE html>
<html>
<head>
    <title>Register - Bengoh Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background:#f3f3f3; }
        .form-control, .form-select {
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
            font-weight: bold;
        }
        /* Hide the admin role box by default */
        #admin-role-section {
            display: none;
            transition: all 0.3s ease;
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
        </ul>
    </div>
</nav>

<div class="container mt-5 text-center">
    <h3 class="mb-4">Register</h3>

    <form method="POST" action="{{ route('register') }}" style="max-width:400px;margin:auto;">
        @csrf

        <input type="text" name="name" class="form-control mb-3" placeholder="Enter your full name" required>
        <input type="email" name="email" class="form-control mb-3" placeholder="Enter your email" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Enter your password" required>
        <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Re-enter your password" required>

        <div class="mb-3 text-start px-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="isAdminCheck" name="is_admin">
                <label class="form-check-label" for="isAdminCheck">
                    Are you an admin?
                </label>
            </div>
        </div>

        <div id="admin-role-section" class="mb-4">
            <label class="form-label d-block text-start px-2">Select Admin Role:</label>
            <select name="role" class="form-select">
                <option value="editor">Content Editor</option>
                <option value="moderator">Moderator</option>
                <option value="superadmin">Super Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-register w-100">REGISTER</button>
    </form>

    @if ($errors->any())
        <div class="text-danger mt-3">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <p class="mt-3">
        Already have an account? <a href="{{ route('login') }}">Sign in here</a>
    </p>
</div>

<script>
    const adminCheckbox = document.getElementById('isAdminCheck');
    const roleSection = document.getElementById('admin-role-section');

    adminCheckbox.addEventListener('change', function() {
        if (this.checked) {
            roleSection.style.display = 'block';
        } else {
            roleSection.style.display = 'none';
        }
    });
</script>

</body>
</html>