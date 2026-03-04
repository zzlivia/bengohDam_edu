<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Courses - Bengoh Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f3f3f3; font-family: Arial, sans-serif; }
        
        /* Hero Section */
        .course-hero {
            background-color: #a9d3ea;
            padding: 60px 20px;
            text-align: center;
            border-radius: 15px;
        }
        .search-bar {
            max-width: 500px;
            margin: 20px auto 0;
            position: relative;
        }
        .search-bar input {
            border-radius: 25px;
            padding-left: 45px;
            border: none;
            height: 45px;
        }
        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
        }

        /* Sidebar Filters */
        .filter-section { border-right: 1px solid #ccc; min-height: 500px; }
        .sort-box { background: #e9ecef; padding: 15px; border-radius: 8px; }

        /* Course Row Item */
        .course-row {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 20px;
            transition: transform 0.2s;
        }
        .course-row img {
            width: 100%;
            border-radius: 8px;
            object-fit: cover;
            height: 160px;
        }
        .meta-text { color: #777; font-size: 0.9rem; }
        .course-title { font-weight: bold; margin-bottom: 5px; }
        .speaker-icon { color: #000; cursor: pointer; }
        
        .btn-action { border-radius: 8px; font-weight: bold; font-size: 0.85rem; }
        .btn-outline-dark:hover { background-color: #f8f9fa; color: #000; }

        footer { border-top: 2px solid #00aaff; padding: 20px 0; background: #fff; margin-top: 40px; }
    </style>
</head>
<body>

{{-- Simplified Nav --}}
<nav class="navbar navbar-expand-lg navbar-light bg-white px-4 border-bottom">
    <a class="navbar-brand fw-bold" href="/">Bengoh Academy</a>
    <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
            <li class="nav-item mx-2"><a class="nav-link active" href="/homepage">Home</a></li>
            <li class="nav-item mx-2"><a class="nav-link active" href="/courses">Courses</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="#">Community Stories</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="#">About the Dam</a></li>
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
    {{-- Header Section --}}
    <div class="course-hero mb-5">
        <p class="mb-1 fw-bold">Bengoh Academy</p>
        <h1 class="fw-bold">Our Courses</h1>
        <form action="{{ route('courses.index') }}" method="GET" class="search-bar">
            <i class="fa fa-search search-icon"></i>
            <input type="text" name="search" class="form-control" placeholder="Search Courses" value="{{ request('search') }}">
        </form>
    </div>

    <div class="row">
        {{-- Sidebar Filters --}}
        <div class="col-md-3 filter-section">
            <div class="sort-box mb-4">
                <form method="GET" action="{{ route('courses.index') }}">

                    <label class="fw-bold mb-2">Sort By</label>

                    <select name="sort" class="form-select" onchange="this.form.submit()">

                        <option value="">Best Match</option>

                        <option value="latest"
                            {{ request('sort') == 'latest' ? 'selected' : '' }}>
                            Latest Added
                        </option>

                        <option value="short"
                            {{ request('sort') == 'short' ? 'selected' : '' }}>
                            Short Learning
                        </option>

                        <option value="updated"
                            {{ request('sort') == 'updated' ? 'selected' : '' }}>
                            Recently Updated
                        </option>

                    </select>

                </form>
            </div>

            <form method="GET" action="{{ route('courses.index') }}">

                <p class="small text-muted mb-3">Refine your search:</p>
                <div class="mb-3">
                    <label class="fw-bold">Subjects</label>
                    <select name="category" class="form-select" onchange="this.form.submit()">
                        <option value="">All Subjects</option>

                        @foreach($categories as $category)
                            <option value="{{ $category }}"
                                {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Course Level</label>
                    <select name="level" class="form-select" onchange="this.form.submit()">
                        <option value="">All Levels</option>

                        @foreach($levels as $level)
                            <option value="{{ $level }}"
                                {{ request('level') == $level ? 'selected' : '' }}>
                                {{ $level }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Course Duration</label>
                    <select name="duration" class="form-select" onchange="this.form.submit()">
                        <option value="">Any Duration</option>

                        @foreach($durations as $duration)
                            <option value="{{ $duration }}"
                                {{ request('duration') == $duration ? 'selected' : '' }}>
                                {{ $duration }} Weeks
                            </option>
                        @endforeach
                    </select>
                </div>

            </form>
        </div>

        {{-- Course List --}}
        <div class="col-md-9">
            <div class="d-flex justify-content-end align-items-center mb-4">
                <span class="me-2">Showing</span>
                <select class="form-select form-select-sm w-auto">
                    <option>3</option>
                    <option>5</option>
                    <option>8</option>
                    <option>10</option>
                </select>
                <span class="ms-2">Courses Per Page</span>
            </div>

            @forelse($courses as $course)
            <div class="course-row shadow-sm">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/' . $course->courseImg) }}" alt="{{ $course->courseName }}">
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex justify-content-between align-items-start">
                            <h5 class="course-title">{{ $course->courseName }}</h5>
                            <i class="fa fa-volume-up speaker-icon"></i>
                        </div>
                        <div class="meta-text mb-2">
                            <span class="me-3">{{ $course->duration ?? '2 Weeks' }}</span>
                            <span>{{ $course->level ?? 'Beginner' }}</span>
                        </div>
                        <p class="small text-muted">
                            {{ Str::limit($course->courseDesc ?? 'Essential for local entrepreneurs and anyone interested in sustainable community business models.', 180) }}
                        </p>
                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('courses.learn', $course->courseID) }}" class="btn btn-outline-dark btn-sm btn-action px-4">
                                Start Learning
                            </a>
                            <a href="{{ route('courses.show', $course->courseID) }}" class="btn btn-outline-secondary btn-sm">
                                View Course
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <div class="text-center py-5">
                    <p>No courses found matching your search.</p>
                </div>
            @endforelse

            {{-- Custom Pagination Arrows --}}
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ $courses->previousPageUrl() }}" class="text-dark"><i class="fa-regular fa-circle-left fa-2x"></i></a>
                <a href="{{ $courses->nextPageUrl() }}" class="text-dark"><i class="fa-regular fa-circle-right fa-2x"></i></a>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="container d-flex gap-5">
        <a href="#" class="text-dark text-decoration-none">Terms</a>
        <a href="#" class="text-dark text-decoration-none">Privacy</a>
        <a href="#" class="text-dark text-decoration-none">Contact</a>
    </div>
</footer>

</body>
</html>