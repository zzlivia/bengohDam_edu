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

                <div class="mb-3">

                    <div class="text-uppercase small text-muted fw-bold">
                        MODULE {{ $loop->iteration }}
                    </div>

                    <div class="fw-semibold mb-2">
                        {{ $module->moduleName }}
                    </div>

                    @foreach($module->lectures as $lecture)

                        <div class="ms-2 mb-1">
                            ○ {{ $lecture->lectName }}
                        </div>

                        {{-- SHOW MCQ IF THIS LECTURE HAS QUESTIONS --}}
                        @if($lecture->mcqs->count() > 0)
                            <a href="{{ route('module.questions', $module->moduleID) }}" class="ms-4 text-primary small text-decoration-none">
                                📝 MCQs {{ $loop->parent->iteration }}
                            </a>
                        @endif

                    @endforeach

                </div>

            @endforeach
                <a class="sidebar-link" href="{{ route('course.feedback') }}">
                    Course Feedback
                </a>
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
                    @foreach($lecture->sections as $section)

                    <h4>{{ $section->section_title }}</h4>

                    @if($section->section_type == 'text')
                        <p>{{ $section->section_content }}</p>
                    @endif

                    @if($section->section_type == 'video')
                        <video controls width="100%">
                            <source src="{{ asset('storage/'.$section->section_file) }}">
                        </video>
                    @endif

                    @if($section->section_type == 'pdf')
                        <a href="{{ asset('storage/'.$section->section_file) }}">Download PDF</a>
                    @endif

                    @endforeach
                <hr>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-outline-dark btn-sm btn-nav">
                        Get the PDF
                    </button>
                    @if($module->lectures->count() > 1)
                        {{-- go to next lecture --}}
                        <button class="btn btn-dark btn-sm btn-nav">
                            NEXT
                        </button>
                    @else
                        {{-- no lecture left, then MCQs --}}
                        <a href="{{ route('module.questions', $module->moduleID) }}"
                        class="btn btn-dark btn-sm btn-nav">
                            NEXT
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>