<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
    <style>
        body {
            background-color: #f5f5f5;
        }

        .sidebar {
            background: #fff;
            height: 100vh;
            overflow-y: auto;
            border-right: 1px solid #ddd;
        }

        .module-title {
            font-size: 12px;
            font-weight: bold;
            color: #666;
            margin-top: 20px;
        }

        .lecture-item {
            font-size: 13px;
            padding: 4px 0;
        }

        .video-box {
            background: #d9d9d9;
            height: 300px;
            border-radius: 6px;
        }

        .content-section {
            background: #fff;
            padding: 20px;
            border-radius: 6px;
        }

        .btn-nav {
            min-width: 120px;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white px-4 border-bottom">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
        <img src="{{ asset('images/bengohdam-logo.png') }}" width="30" class="me-2"> Bengoh Academy
    </a>

    <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
            <li class="nav-item mx-2"><a class="nav-link active" href="/homepage">Home</a></li>
            <li class="nav-item mx-2"><a class="nav-link active" href="/courses">Courses</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="#">Community Stories</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="#">About the Dam</a></li>
            <li class="nav-item dropdown mx-2">
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
            <li class="nav-item mx-2 d-flex align-items-center">
                @auth
                    <span class="nav-link">Hi, {{ auth()->user()->userName }}</span>
                @else
                    <a class="nav-link text-primary fw-bold px-1" href="{{ route('register') }}">Register</a>
                    <span class="text-muted">|</span>
                    <a class="nav-link text-primary fw-bold px-1" href="{{ route('login') }}">Sign In</a>
                @endauth
            </li>
        </ul>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">

        <!--sidebar -->
        <div class="col-md-3 sidebar p-3">
            <h6 class="fw-bold mb-3">Course Modules</h6>
            @foreach($course->modules as $module)
                <div class="module-title">
                    MODULE {{ $loop->iteration }}
                </div>
                <div class="fw-semibold mb-1">
                    {{ $module->moduleName }}
                </div>
                @foreach($module->lectures as $lecture)
                <li class="d-flex justify-content-between align-items-center mb-2">
                    <span>{{ $lecture->lectName }}</span>
                    <span class="text-muted small">
                        ⏱ {{ $lecture->lect_duration }} mins
                    </span>
                </li>
                @endforeach
            @endforeach

        </div>

        <!-- main content -->
        <div class="col-md-9 p-4">
            <!-- course name -->
            <div class="text-center mb-3">
                <span class="badge bg-light text-dark px-4 py-2">
                    {{ $course->courseName }}
                </span>
            </div>
            <!-- video section -->
            <div class="video-box d-flex justify-content-center align-items-center mb-4">
                <span style="font-size: 40px;">▶</span>
            </div>
            <!-- lesson content -->
            <div class="content-section">
                <h6 class="fw-bold">Lesson Overview</h6>
                <p>
                    In this lesson, you will learn about the selected lecture from the course.
                </p>
                <h6 class="fw-bold mt-3">Key Points</h6>
                <ul>
                    <li>Understand the main topic</li>
                    <li>Learn important concepts</li>
                    <li>Explore practical examples</li>
                </ul>
                <hr>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-outline-dark btn-sm btn-nav">
                        Get the PDF
                    </button>
                    <button class="btn btn-dark btn-sm btn-nav">
                        NEXT
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>