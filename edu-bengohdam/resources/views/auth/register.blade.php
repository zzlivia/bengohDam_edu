<!DOCTYPE html>
<html>
<head>
    <title>Register - Bengoh Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

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
        #admin-role-section { display: none; transition: all 0.3s ease; }

        /* Style for the Eye Icon */
        .password-container { position: relative; }
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
    </style>
</head>
<body>

<div class="container mt-5 text-center">
    <h3 class="mb-4">Register</h3>

    <form method="POST" action="{{ route('register') }}" style="max-width:400px;margin:auto;" autocomplete="off">
        @csrf

        <input type="text" name="name" class="form-control mb-3" placeholder="Enter your full name" required autocomplete="off">
        
        <input type="email" name="email" class="form-control mb-3" placeholder="Enter your email" required autocomplete="off">

        <div class="password-container mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required autocomplete="new-password">
            <i class="bi bi-eye-slash toggle-password" id="togglePassword"></i>
        </div>

        <div class="password-container mb-3">
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Re-enter your password" required autocomplete="new-password">
            <i class="bi bi-eye-slash toggle-password" id="toggleConfirmPassword"></i>
        </div>

        <div class="mb-3 text-start px-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="isAdminCheck" name="is_admin">
                <label class="form-check-label" for="isAdminCheck">Are you an admin?</label>
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
</div>

<script>
    // 1. Admin Toggle Logic
    const adminCheckbox = document.getElementById('isAdminCheck');
    const roleSection = document.getElementById('admin-role-section');

    adminCheckbox.addEventListener('change', function() {
        roleSection.style.display = this.checked ? 'block' : 'none';
    });

    // 2. Password Visibility Logic
    function setupPasswordToggle(toggleId, inputId) {
        const toggle = document.getElementById(toggleId);
        const input = document.getElementById(inputId);

        toggle.addEventListener('click', function() {
            // Toggle type
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            // Toggle icon
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    }

    setupPasswordToggle('togglePassword', 'password');
    setupPasswordToggle('toggleConfirmPassword', 'password_confirmation');
</script>

</body>
</html>