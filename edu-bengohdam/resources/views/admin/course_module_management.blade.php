@extends('layouts.admin')

@section('content')

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

{{-- search course and add course --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <input type="text" class="form-control w-50" placeholder="Search Course/Modules">
    <a href="{{ route('admin.course.module.create') }}" class="btn btn-primary">
        + Add Course / Module
    </a>
</div>

{{-- table --}}
<div class="card-box">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Author</th>
                <th>No of Modules</th>
                <th>Availability</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($courses as $index => $course)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $course->courseCode }}</td>
            <td>{{ $course->courseName }}</td>
            <td>{{ $course->courseAuthor }}</td>
            <td>{{ $course->modules->count() }}</td>
            <td>
                @if($course->isAvailable)
                    <span class="badge bg-success">Available</span> {{-- green badge --}}
                @else
                    <span class="badge bg-danger">Hidden</span> {{-- red badge --}}
                @endif
            </td>
            <td>
                <a href="#">View</a> |
                <a href="#">Edit</a> |
                <a href="#">Delete</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{-- save change button --}}
    <div class="text-center mt-3">
        <button class="btn btn-dark">Save Changes</button>
    </div>
</div>
@endsection