@extends('layouts.admin')

@section('content')

<div class="container">
    <h3 class="mb-4">Add Course</h3>
    <form method="POST" action="{{ route('admin.course.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Course Code</label>
            <input type="text" class="form-control" name="courseCode" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Course Name</label>
            <input type="text" class="form-control" name="courseName" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Course Author</label>
            <input type="text" class="form-control" name="courseAuthor" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Course Description</label>
            <textarea class="form-control" name="courseDesc" rows="4"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Course Category</label>
            <input type="text" class="form-control" name="courseCategory">
        </div>
        <div class="mb-3">
            <label class="form-label">Course Level</label>
            <select class="form-control" name="courseLevel">
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
                <option value="Advanced">Advanced</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Course Duration (hours)</label>
            <input type="number" class="form-control" name="courseDuration">
        </div>
        <div class="mb-3">
            <label class="form-label">Course Image</label>
            <input type="file" class="form-control" name="courseImg">
        </div>
        <div class="mb-3">
            <label class="form-label">Availability</label>
            <select class="form-control" name="isAvailable">
                <option value="1">Available</option>
                <option value="0">Not Available</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">
            Save Course
        </button>

    </form>
</div>
@endsection