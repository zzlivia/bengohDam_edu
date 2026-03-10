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

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Author</label>
                        <input type="text" class="form-control" name="courseAuthor" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" class="form-control" name="courseCategory" placeholder="e.g. Programming, Design" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Level</label>
                        <select class="form-control" name="courseLevel" required>
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Duration (Hours)</label>
                        <input type="number" class="form-control" name="courseDuration" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Course Thumbnail</label>
                        <input type="file" class="form-control" name="courseImg" accept="image/*">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="courseDesc" rows="4" required></textarea>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="isAvailable" value="1" id="isAvailable" checked>
                    <label class="form-check-label" for="isAvailable">Make this course available immediately</label>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Save Course</button>
                    <a href="{{ route('admin.course.module') }}" class="btn btn-secondary">Back</a>
                </div>
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
                <a href="{{ route('admin.course.module') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
        
        {{-- LECTURE FORM (NEW) --}}
        <div class="tab-pane fade" id="lecture-form">
            <form method="POST" action="{{ route('admin.lecture.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Lecture ID/Code</label>
                        <input type="text" class="form-control" name="lectID" placeholder="e.g. LEC-001" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Select Module</label>
                        <select class="form-control" name="moduleID" required>
                            <option value="">-- Choose a Module --</option>
                            @foreach($modules as $module)
                                <option value="{{ $module->moduleID }}">{{ $module->moduleName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Lecture Name</label>
                        <input type="text" class="form-control" name="lectName" placeholder="e.g. Setup and Installation" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Duration (Minutes)</label>
                        <input type="number" class="form-control" name="lect_duration" placeholder="e.g. 15" required>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-info text-white">Save Lecture</button>
                    <a href="{{ route('admin.course.module') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection