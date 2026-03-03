<!DOCTYPE html>
<html>
<head>
    <title>User Management - Bengoh Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #eef3f7;
        }

        .sidebar {
            height: 100vh;
            background: #ffffff;
            padding: 20px;
            border-right: 1px solid #ddd;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
            margin-bottom: 5px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background: #dce7f5;
            font-weight: 500;
        }

        .card-box {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0px 3px 8px rgba(0,0,0,0.05);
        }

        .btn-primary-custom {
            background: #0d2c54;
            color: white;
            border-radius: 10px;
            padding: 8px 16px;
        }

        .btn-primary-custom:hover {
            background: #0a2242;
        }

        .btn-danger-custom {
            background: #1c355e;
            color: white;
            border-radius: 10px;
            padding: 8px 16px;
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        {{-- Sidebar --}}
        <div class="col-md-2 sidebar">

            <h5 class="fw-bold mb-4">Bengoh Academy</h5>

            <a href="{{ route('admin.dashboard') }}"class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.user.management') }}" class="active">User Management</a>
            <a href="#">Course/Module Management</a>
            <a href="#">Progress</a>
            <a href="#">Announcements</a>
            <a href="#">Reports</a>

            <div class="mt-5">
                <a href="#">Settings</a>
                <a href="#">Help & Support</a>
                <a href="#">Sign Out</a>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="col-md-10 p-4">

            <h4 class="fw-bold mb-4">Summary</h4>

            <div class="row mb-4">

                <div class="col-md-3">
                    <div class="card-box text-center">
                        <h6>Total Users</h6>
                        <h2>{{ $totalUsers }}</h2>
                        <small>Engaged in this week</small>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-box text-center">
                        <h6>Total Users</h6>
                        <h2>{{ $totalUsers }}</h2>
                        <small>Engaged in this week</small>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-box text-center">
                        <h6>Total Users</h6>
                        <h2>{{ $totalUsers }}</h2>
                        <small>Engaged in this week</small>
                    </div>
                </div>

            </div>

            {{-- Search + Buttons --}}
            <div class="d-flex justify-content-between align-items-center mb-3">

                <input type="text" class="form-control w-50" placeholder="Search User">

                <div>
                    <button class="btn btn-primary-custom">Add User Manually</button>
                    <button class="btn btn-danger-custom">Remove User</button>
                </div>
            </div>

            {{-- Table --}}
            <div class="card-box">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Age</th>
                            <th>Engagement</th>
                            <th>Rank</th>
                            <th>Completed Courses</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No users found</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <div class="text-center mt-5">
                <a href="/" class="btn btn-primary-custom">Home</a>
            </div>

        </div>

    </div>
</div>

</body>
</html>