@extends('layouts.learner')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/view_all_course.css') }}">
@endsection

@section('content')

<div class="container mt-4">

    {{-- Hero Section --}}
    <div class="course-hero mb-5">
        <p class="mb-1 fw-bold">Bengoh Academy</p>
        <h1 class="fw-bold">Our Courses</h1>

        <form action="{{ route('courses.index') }}" method="GET" class="search-bar">
            <i class="fa fa-search search-icon"></i>
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search Courses"
                   value="{{ request('search') }}">
        </form>
    </div>

    <div class="row">

        {{-- Sidebar --}}
        <div class="col-md-3 filter-section">

            <div class="sort-box mb-4">
                <form method="GET" action="{{ route('courses.index') }}">

                    <label class="fw-bold mb-2">Sort By</label>

                    <select name="sort" class="form-select" onchange="this.form.submit()">
                        <option value="">Best Match</option>

                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>
                            Latest Added
                        </option>

                        <option value="short" {{ request('sort') == 'short' ? 'selected' : '' }}>
                            Short Learning
                        </option>

                        <option value="updated" {{ request('sort') == 'updated' ? 'selected' : '' }}>
                            Recently Updated
                        </option>
                    </select>

                </form>
            </div>


            <form method="GET" action="{{ route('courses.index') }}">

                <p class="small text-muted mb-3">Refine your search:</p>

                {{-- Category --}}
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


                {{-- Level --}}
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


                {{-- Duration --}}
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

                        <h5 class="course-title">{{ $course->courseName }}</h5>

                        <div class="meta-text mb-2">
                            <span class="me-3">{{ $course->duration ?? '2 Weeks' }}</span>
                            <span>{{ $course->level ?? 'Beginner' }}</span>
                        </div>

                        <p class="small text-muted">
                            {{ Str::limit($course->courseDesc ?? 'Course description here.',180) }}
                        </p>

                        <div class="d-flex justify-content-end gap-2 mt-3">

                            <a href="{{ route('courses.learn', $course->courseID) }}"
                               class="btn btn-outline-dark btn-sm btn-action px-4">
                               Start Learning
                            </a>

                            <a href="{{ route('courses.show', $course->courseID) }}"
                               class="btn btn-outline-secondary btn-sm">
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


            {{-- Pagination --}}
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ $courses->previousPageUrl() }}" class="text-dark">
                    <i class="fa-regular fa-circle-left fa-2x"></i>
                </a>

                <a href="{{ $courses->nextPageUrl() }}" class="text-dark">
                    <i class="fa-regular fa-circle-right fa-2x"></i>
                </a>
            </div>

        </div>

    </div>

</div>

@endsection