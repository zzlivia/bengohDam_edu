<!DOCTYPE html>
<html>
<head>
    <title>Bengoh Academy - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- add manifest link --}}
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0d6efd">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- admin css -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <h5 class="fw-bold mb-4">Bengoh Academy</h5>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('admin.user.management') }}" class="{{ request()->routeIs('admin.user.management') ? 'active' : '' }}">User Management</a>
                <a href="{{ route('admin.course.module') }}" class="{{ request()->routeIs('admin.course.module') ? 'active' : '' }}">Course/Module Management</a>
                <a href="{{ route('admin.progress') }}" class="{{ request()->routeIs('admin.progress') ? 'active' : '' }}">Progress</a>
                <a href="{{ route('admin.announcements') }}" class="{{ request()->routeIs('admin.announcements') ? 'active' : '' }}">Announcements</a>
                <a href="{{ route('admin.reports') }}" class="{{ request()->routeIs('admin.reports') ? 'active' : '' }}">Reports</a>
            </div>
            <div class="mt-auto">
                <a href="{{ route('admin.settings') }}"
                class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                Settings
                </a>
                <a href="{{ route('admin.help') }}">Help & Support</a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-logout">Sign Out</button>
                </form>
            </div>
        </div>
        <div class="col-md-10 p-0">
            <div class="topbar d-flex justify-content-between align-items-center p-3 px-4">

                <!-- LEFT: Language -->
                <div class="d-flex align-items-center">
                    <span class="fw-semibold me-1">Languages</span>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <!-- RIGHT: User + Notification -->
                <div class="d-flex align-items-center gap-4">
                    <!-- User Info -->
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person-circle fs-4 me-2"></i>
                        <div class="lh-sm">
                            <div class="fw-bold">{{ auth()->user()->name }}</div>
                            <small class="text-muted">Administrator</small>
                        </div>
                    </div>
                    <!-- notification -->
                    <div class="dropdown">
                        <div class="position-relative" data-bs-toggle="dropdown" style="cursor:pointer;">
                            <i class="bi bi-bell fs-5"></i>
                            @if($totalNotifications > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $totalNotifications }}
                            </span>
                            @endif
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <!-- receive notification of user forgot password -->
                            <li>
                                <a class="dropdown-item" href="#"">
                                    Password Reset Requests
                                    <span class="badge bg-danger">{{ $forgotRequests }}</span>
                                </a>
                            </li>
                            <!-- course feedback -->
                            <li>
                                <a class="dropdown-item" href="#"">
                                    Course Feedback
                                    <span class="badge bg-warning">{{ $feedbackCount }}</span>
                                </a>
                            </li>
                            <!-- notification on announcement to be reviewed -->
                            <li>
                                <a class="dropdown-item" href="#"">
                                    Announcements To Review
                                    <span class="badge bg-primary">{{ $announcementReview }}</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="p-4">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
{{-- add service worker --}}
<script>
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/service-worker.js')
    .then(function() {
        console.log("Service Worker Registered");
    });
}
</script>
</body>
</html>