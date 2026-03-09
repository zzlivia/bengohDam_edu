@extends('layouts.admin')

@section('content')
<div class="container">
    <h3 class="mb-4">Create Course or Module</h3>
    
    <ul class="nav nav-tabs mb-4" id="managementTab" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="course-tab" data-bs-toggle="tab" data-bs-target="#course-form" type="button">Add Course</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="module-tab" data-bs-toggle="tab" data-bs-target="#module-form" type="button">Add Module</button>
        </li>
    </ul>

    <div class="tab-content">
        {{-- COURSE FORM --}}
        <div class="tab-pane fade show active" id="course-form">
            <form method="POST" action="{{ route('admin.course.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Course Code</label>
                        <input type="text" class="form-control" name="courseCode" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Course Name</label>
                        <input type="text" class="form-control" name="courseName" required>
                    </div>
                </div>
                {{-- ... include your other course fields here (Author, Category, etc.) ... --}}
                <button type="submit" class="btn btn-success">Save Course</button>
            </form>
        </div>

        {{-- MODULE FORM --}}
        <div class="tab-pane fade" id="module-form">
            <form method="POST" action="{{ route('admin.module.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Select Course</label>
                    <select class="form-control" name="courseID" required>
                        <option value="">-- Choose a Course --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->courseID }}">{{ $course->courseName }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Module Name</label>
                    <input type="text" class="form-control" name="moduleName" placeholder="e.g. Introduction to Laravel" required>
                </div>

                <button type="submit" class="btn btn-primary">Save Module</button>
            </form>
        </div>
    </div>
</div>
@endsection