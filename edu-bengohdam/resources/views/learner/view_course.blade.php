<!DOCTYPE html>
<html>
<head>
    <title>{{ $course->courseName }} - Bengoh Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#ffffff;">

{{-- Simplified Nav --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white px-4 border-bottom">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
        <img src="{{ asset('images/bengohdam-logo.png') }}" width="30" class="me-2"> Bengoh Academy
    </a>

    <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">

            <li class="nav-item mx-2">
                <a class="nav-link" href="/homepage">Home</a>
            </li>

            <li class="nav-item mx-2">
                <a class="nav-link active" href="{{ route('courses.index') }}">Courses</a>
            </li>

            <li class="nav-item mx-2">
                <a class="nav-link" href="#">Community Stories</a>
            </li>

            <li class="nav-item mx-2">
                <a class="nav-link" href="#">About the Dam</a>
            </li>

            <li class="nav-item mx-2">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-sm btn-outline-danger">Logout</button>
                    </form>
                @else
                    <a class="nav-link text-primary" href="{{ route('login') }}">
                        Register | Sign In
                    </a>
                @endauth
            </li>

        </ul>
    </div>
</nav>

<div class="container mt-4">
    <!-- Course Banner Image -->
    <div class="text-center mb-4">
        <img src="{{ asset('storage/' . $course->courseImg) }}" alt="{{ $course->courseName }}">
    </div>
    <!-- Course Info -->
    <div class="row mb-4">
        <div class="col-md-9">
            <h4>{{ $course->courseName }}</h4>

            <p class="text-muted">
                {{ $course->courseDesc }}
            </p>
        </div>
        <div class="col-md-3 text-end">
            <small class="text-muted">
                Author: {{ $course->courseAuthor }}
            </small>
        </div>
    </div>
    <!-- Modules -->
    <div class="row">
        @foreach($course->modules as $index => $module)
        <div class="col-md-6 mb-4">
            <div class="card p-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">{{ $module->moduleName }}</h6>
                    <strong>0{{ $index + 1 }}</strong>
                </div>
                <!-- Lectures List -->
                <ul class="list-unstyled">
                    @foreach($module->lectures as $lecture)
                        <li class="d-flex justify-content-between align-items-center mb-2">
                            <span>{{ $lecture->lectName }}</span>
                            <span class="text-muted small">
                                @php
                                    $duration = null;

                                    foreach($lecture->materials as $material) {
                                        if ($material->video) {
                                            $duration = $material->video->videoLearningDuration;
                                        }
                                    }
                                @endphp
                                @if($duration)
                                    ⏱ {{ $duration }} mins
                                @endif
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Bottom Buttons -->
    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('course.feedback', $course->courseID) }}" class="btn btn-outline-secondary">
            View Course Feedback
        </a>
        <a href="{{ route('courses.learn', $course->courseID) }}" class="btn btn-outline-dark btn-sm btn-action px-4">
            Enrol
        </a>
    </div>
</div>

<footer class="mt-5 py-3 border-top bg-white text-center">
    <small>
        <a href="#" class="mx-2 text-decoration-none">Terms</a>
        <a href="#" class="mx-2 text-decoration-none">Privacy</a>
        <a href="#" class="mx-2 text-decoration-none">Contact</a>
    </small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>