<!DOCTYPE html>
<html>
<head>
    <title>Bengoh Academy - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#eaf1f7;
        }

        .sidebar{
            height:100vh;
            background:white;
            padding:20px;
            border-right:1px solid #ddd;
        }

        .sidebar a{
            display:block;
            padding:10px;
            border-radius:8px;
            text-decoration:none;
            color:#333;
            margin-bottom:6px;
        }

        .sidebar a.active,
        .sidebar a:hover{
            background:#d6e4f5;
            font-weight:500;
        }

        .card-box{
            background:white;
            border-radius:12px;
            padding:20px;
            box-shadow:0 3px 8px rgba(0,0,0,0.05);
        }

        .topbar{
            background:white;
            border-bottom:1px solid #ddd;
        }

    </style>
</head>

<body>

<div class="container-fluid">
<div class="row">

<!-- SIDEBAR -->
<div class="col-md-2 sidebar">

    <h5 class="fw-bold mb-4">Bengoh Academy</h5>

    <a href="{{ route('admin.dashboard') }}"
    class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    Dashboard
    </a>

    <a href="{{ route('admin.user.management') }}"
    class="{{ request()->routeIs('admin.user.management') ? 'active' : '' }}">
    User Management
    </a>

    <a href="{{ route('admin.course.module') }}"
    class="{{ request()->routeIs('admin.course.module') ? 'active' : '' }}">
    Course/Module Management
    </a>

    <a href="{{ route('admin.progress') }}"
    class="{{ request()->routeIs('admin.progress') ? 'active' : '' }}">
    Progress
    </a>

    <a href="{{ route('admin.announcements') }}"
    class="{{ request()->routeIs('admin.announcements') ? 'active' : '' }}">
    Announcements
    </a>

    <a href="{{ route('admin.reports') }}"
    class="{{ request()->routeIs('admin.reports') ? 'active' : '' }}">
    Reports
    </a>

    <div class="mt-5">
        <a href="#">Settings</a>
        <a href="#">Help & Support</a>
        <a href="#">Sign Out</a>
    </div>

</div>

<!-- MAIN CONTENT -->
<div class="col-md-10 p-0">

    <!-- TOPBAR -->
    <div class="topbar d-flex justify-content-between align-items-center p-3 px-4">

        <div>
            <strong>Languages</strong>
        </div>

        <div>
            <span class="fw-bold">Olivia Geema</span>
            <small class="text-muted">Administrator</small>
        </div>

    </div>

    <!-- PAGE CONTENT -->
    <div class="p-4">

        @yield('content')

    </div>

</div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@stack('scripts')

</body>
</html>