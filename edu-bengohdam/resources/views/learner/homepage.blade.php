<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bengoh Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background-color: #ffffff;
            font-family: Arial, sans-serif;
        }

        .hero-img {
            width: 100%;
            border-radius: 15px;
            /* Match the screenshot's soft look */
        }

        .feature-box {
            background: #a9d3ea;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            height: 100%;
        }

        .course-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            background: #fff;
            text-align: center;
            height: 100%;
        }

        .course-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

        /* Success Story & Dam History Styles */
        .story-card, .history-card {
            background: #fff;
            border: 1px solid #999;
            border-radius: 15px;
            padding: 20px;
            height: 100%;
        }

        .profile-icon {
            font-size: 80px;
            color: #000;
        }

        footer {
            margin-top: 50px;
            padding: 20px;
            text-align: center;
            background: #fff;
            border-top: 2px solid #00aaff;
        }
        
        a { text-decoration: none; color: inherit; }
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
                    {{-- Split into two separate links --}}
                    <a class="nav-link text-primary fw-bold px-1" href="{{ route('register') }}">Register</a>
                    <span class="text-muted">|</span>
                    <a class="nav-link text-primary fw-bold px-1" href="{{ route('login') }}">Sign In</a>
                @endauth
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <div class="mb-4">
        <img src="{{ asset('images/homepage.png') }}" class="hero-img shadow-sm">
    </div>

    {{-- Feature Boxes --}}
    <div class="row text-center mb-5 g-3">
        <div class="col-md-4">
            <div class="feature-box">
                <i class="fa-solid fa-handshake fs-3 mb-2"></i>
                <h6>Built for Bengoh</h6>
                <small>Courses designed to foster community-owned enterprises</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box">
                <i class="fa-solid fa-graduation-cap fs-3 mb-2"></i>
                <h6>Eco-centric Learning</h6>
                <small>Training in eco-tourism</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box">
                <i class="fa-solid fa-gear fs-3 mb-2"></i>
                <h6>Ready Skills</h6>
                <small>Get hands-on skills</small>
            </div>
        </div>
    </div>

    {{-- Featured Courses --}}
    <h5 class="mb-3 fw-bold">Featured Courses</h5>
    <div class="row">
        @foreach(\App\Models\Course::where('isAvailable', 1)->take(4)->get() as $course)
            <div class="col-md-3 mb-3">
                <div class="course-card">
                    {{-- call out the path in storage\learners to display the course image #01 --}}
                    <img src="{{ asset('storage/' . $course->courseImg) }}" alt="{{ $course->courseName }}">
                    <h6 class="mt-2 fw-bold">{{ $course->courseName }}</h6>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center mb-5">
        <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary btn-sm">
            View All Courses
        </a>
    </div>

    {{-- Community Success Stories --}}
    <h5 class="text-center mb-4 fw-bold">Community Success Story</h5>
    <div class="row mb-3 justify-content-center">
        <div class="col-md-5 mb-3">
            <div class="story-card d-flex align-items-center">
                <i class="fa-solid fa-user-tie profile-icon me-3"></i>
                <div>
                    <h6 class="fw-bold mb-1">Atta Anak Peter</h6>
                    <p class="small mb-0">"Thanks to Bengoh Academy, I launched a homestay."</p>
                </div>
            </div>
        </div>
        <div class="col-md-5 mb-3">
            <div class="story-card d-flex align-items-center">
                <i class="fa-solid fa-user-tie profile-icon me-3"></i>
                <div>
                    <h6 class="fw-bold mb-1">Oscar Anak Isah</h6>
                    <p class="small mb-0">"Thanks to Bengoh Academy, I learned a lot on customer service and communication skills."</p>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mb-5">
        <a href="{{ route('community.stories') }}" class="text-primary small text-decoration-underline">Read More Community Stories</a>
    </div>

    {{-- Bengoh Dam Histories --}}
    <h5 class="mb-3 fw-bold">The Bengoh Dam Histories</h5>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="history-card">
                <h6 class="small fw-bold">Function & Usage</h6>
                <div style="height: 150px;"></div> {{-- Placeholder for content --}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="history-card">
                <h6 class="small fw-bold">Impact on the Community</h6>
                <div style="height: 150px;"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="history-card">
                <h6 class="small fw-bold">Nature Tourism Attraction</h6>
                <div style="height: 150px;"></div>
            </div>
        </div>
    </div>

</div>

<footer>
    <div class="container d-flex justify-content-start gap-4 small fw-bold">
        <a href="#">Terms</a>
        <a href="#">Privacy</a>
        <a href="#">Contact</a>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>