<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bengoh Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f3f3f3;
            font-family: Arial, sans-serif;
        }

        .hero-img {
            width: 100%;
            border-radius: 15px;
            border: 3px solid #4da6ff;
        }

        .feature-box {
            background: #a9d3ea;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .course-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            background: #fff;
            text-align: center;
        }

        .course-card img {
            width: 100%;
            border-radius: 8px;
        }

        footer {
            margin-top: 50px;
            padding: 20px;
            text-align: center;
            background: #eaeaea;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white px-4">
    <a class="navbar-brand fw-bold" href="/">Bengoh Academy</a>

    <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">

            <li class="nav-item mx-2">
                <a class="nav-link active" href="/">Home</a>
            </li>

            <li class="nav-item mx-2">
                <a class="nav-link" href="/courses">Courses</a>
            </li>

            <li class="nav-item mx-2">
                <a class="nav-link" href="#">Community Stories</a>
            </li>

            <li class="nav-item mx-2">
                <a class="nav-link" href="#">About the Dam</a>
            </li>

            {{-- authentication section --}}
            <li class="nav-item mx-2">
                @auth
                    <span class="nav-link">Hi, {{ auth()->user()->userName }}</span>
                @endauth
            </li>

            <li class="nav-item mx-2">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-sm btn-outline-danger">Logout</button>
                    </form>
                @else
                    <a class="nav-link text-primary" href="{{ route('login') }}">Register | Sign In</a>
                @endauth
            </li>

        </ul>
    </div>
</nav>


<div class="container mt-4">

    {{-- Hero Image --}}
    <div class="mb-4">
        <img src="{{ asset('images/sign-in-authentication.png') }}" class="hero-img">
    </div>

    <div class="text-center my-3">

        @auth
            <h5>Welcome back, {{ auth()->user()->userName }} 👋</h5>
        @endauth

        @guest
            <h5>Welcome to Bengoh Academy 🌿</h5>
        @endguest

    </div>

    {{-- Feature Boxes --}}
    <div class="row text-center mb-4">
        <div class="col-md-4">
            <div class="feature-box">
                <h6>Built for Bengoh</h6>
                <small>Courses designed to foster community-owned enterprises</small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="feature-box">
                <h6>Eco-centric Learning</h6>
                <small>Training in eco-tourism</small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="feature-box">
                <h6>Ready Skills</h6>
                <small>Get hands-on skills</small>
            </div>
        </div>
    </div>

    {{-- featured courses --}}
    <h5 class="mb-3">Featured Courses</h5>

    <div class="row">
        @foreach(\App\Models\Course::where('isAvailable',1)->take(4)->get() as $course)
            <div class="col-md-3 mb-3">
                <div class="course-card">
                    <img src="{{ asset($course->courseImg) }}">
                    <h6 class="mt-2">{{ $course->courseName }}</h6>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center my-4">
        @auth
            <a href="/courses" class="btn btn-primary">Browse Courses</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">View All Courses</a>
        @endauth
    </div>

</div>

<footer>
    <a href="#">Terms</a> |
    <a href="#">Privacy</a> |
    <a href="#">Contact</a>
</footer>

</body>
</html>