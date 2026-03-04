<!DOCTYPE html>
<html>
<head>
    <title>Course/Module Management - Bengoh Academy</title>
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

        .btn-dark-custom {
            background: #0d2c54;
            color: white;
            border-radius: 8px;
            padding: 6px 14px;
        }
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        {{-- Sidebar --}}
        <div class="col-md-2 sidebar">

            <h5 class="fw-bold mb-4">Bengoh Academy</h5>

            <a href="{{ route('admin.dashboard') }}">Dashboard</a>

            <a href="{{ route('admin.user.management') }}">User Management</a>

            <a href="{{ route('admin.course.module') }}">Course/Module Management</a>

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

            <h4 class="fw-bold mb-4">Course/Module Management</h4>

            {{-- Summary Cards --}}
            <div class="row mb-4">

                <div class="col-md-3">
                    <div class="card-box text-center">
                        <h6>Total courses</h6>
                        <h2>{{ $totalCourses }}</h2>
                        <small>Engaged in this week</small>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-box text-center">
                        <h6>Total modules</h6>
                        <h2>{{ $totalModules }}</h2>
                        <small>Engaged in this week</small>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-box text-center">
                        <h6>Total courses taken</h6>
                        <h2>{{ $coursesTaken }}</h2>
                        <small>Engaged in this week</small>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-box text-center">
                        <h6>Total modules completed</h6>
                        <h2>{{ $modulesCompleted }}</h2>
                        <small>Engaged in this week</small>
                    </div>
                </div>

            </div>

            {{-- Search --}}
            <div class="mb-3">
                <input type="text" class="form-control w-50" placeholder="Search Course/Modules">
            </div>

            {{-- Table --}}
            <div class="card-box">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Course Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($courses as $index => $course)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $course['name'] }}</td>
                            <td>
                                <a href="#">View</a> |
                                <a href="#">Delete</a> |
                                <a href="#">Edit</a> |
                                <a href="#">Hide</a> |
                                <a href="#">Show</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="text-center mt-3">
                    <button class="btn btn-dark-custom">Save Changes</button>
                </div>

            </div>

        </div>

    </div>
</div>

</body>
</html>