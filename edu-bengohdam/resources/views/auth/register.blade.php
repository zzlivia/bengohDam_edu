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

        /* register button */
        .btn-register {
            background:#dcd6c9;
            border:none;
            border-radius:10px;
            padding:8px 20px;
            font-weight: bold;
        }

        /* role section transition */
        #admin-role-section { 
            display: none; 
            transition: all 0.3s ease; 
        }

        /* eye icon */
        .password-container { position: relative; }
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }

        /* styling for the bottom link */
        .signin-link {
            text-decoration: none;
            color: #6c757d;
            font-weight: 500;
        }
        .signin-link:hover {
            color: #000;
            text-decoration: underline;
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

            <div class="mb-3 d-flex justify-content-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="isAdminCheck" name="is_admin">
                    <label class="form-check-label" for="isAdminCheck">Are you an admin?</label>
                </div>
            </div>

            <div id="admin-role-section" class="mb-4">
                <label class="form-label d-block text-start px-2">Select Admin Role:</label>
                <select name="role" class="form-select">
                    <option value="superadmin">Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-register w-100">REGISTER</button>
            
            <div class="mt-4">
                <p class="text-muted">Already have an account? 
                    <a href="{{ route('login') }}" class="signin-link">Sign in here</a>
                </p>
            </div>
        </form>
    </div>

    <script>
        // validation check
        const adminCheckbox = document.getElementById('isAdminCheck');
        const roleSection = document.getElementById('admin-role-section');

        adminCheckbox.addEventListener('change', function() {
            roleSection.style.display = this.checked ? 'block' : 'none';
        });

        // password visibility
        function setupPasswordToggle(toggleId, inputId) {
            const toggle = document.getElementById(toggleId);
            const input = document.getElementById(inputId);

            toggle.addEventListener('click', function() {
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.classList.toggle('bi-eye');
                this.classList.toggle('bi-eye-slash');
            });
        }

        setupPasswordToggle('togglePassword', 'password');
        setupPasswordToggle('toggleConfirmPassword', 'password_confirmation');
    </script>
</body>
</html>