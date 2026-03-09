@extends('layouts.admin')

@section('content')

<h4 class="fw-bold mb-4">Course/Module Management</h4>

{{-- Summary Cards --}}
<div class="row mb-4">
    @php
        $stats = [
            ['label' => 'Total courses', 'value' => $totalCourses],
            ['label' => 'Total modules', 'value' => $totalModules],
            ['label' => 'Total courses taken', 'value' => $coursesTaken],
            ['label' => 'Total modules completed', 'value' => $modulesCompleted],
        ];
    @endphp

    @foreach($stats as $stat)
    <div class="col-md-3">
        <div class="card-box text-center">
            <h6>{{ $stat['label'] }}</h6>
            <h2>{{ $stat['value'] }}</h2>
            <small>Engaged in this week</small>
        </div>
    </div>
    @endforeach
</div>

{{-- Search and Add --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <input type="text" class="form-control w-50" placeholder="Search Course/Modules">
    <a href="{{ route('admin.course.module.create') }}" class="btn btn-primary">
        + Add Course / Module
    </a>
</div>

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
                <span class="badge {{ $course->isAvailable ? 'bg-success' : 'bg-danger' }}">
                    {{ $course->isAvailable ? 'Available' : 'Hidden' }}
                </span>
            </td>
            <td>
                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewCourseModal{{ $course->courseID }}"> View </button>
                <a href="{{ route('admin.course.edit', $course->courseID) }}" class="btn btn-sm btn-warning"> Edit </a>
                
                <form action="{{ route('admin.course.delete', $course->courseID) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"> Delete </button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {{-- Modals (Keep only one loop, ideally after the table) --}}
    @foreach($courses as $course)
    <div class="modal fade" id="viewCourseModal{{ $course->courseID }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Course Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card p-3">
                        <h4>{{ $course->courseName }}</h4>
                        <p><strong>Course Code:</strong> {{ $course->courseCode }}</p>
                        <p><strong>Author:</strong> {{ $course->courseAuthor }}</p>
                        <p><strong>Category:</strong> {{ $course->courseCategory }}</p>
                        <p><strong>Level:</strong> {{ $course->courseLevel }}</p>
                        <p><strong>Duration:</strong> {{ $course->courseDuration }} hours</p>
                        <p><strong>Description:</strong></p>
                        <p>{{ $course->courseDesc }}</p>
                        @if($course->courseImg)
                            <img src="{{ asset('storage/'.$course->courseImg) }}" class="img-fluid rounded" style="max-height:200px;">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

      
    {{--<div class="text-center mt-3">
        <button class="btn btn-dark">Save Changes</button>
    </div>--}}
</div>
@endsection