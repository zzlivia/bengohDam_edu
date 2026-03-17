@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>Edit Course</h3>
    <form method="POST" action="{{ route('admin.course.update',$course->courseID) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="mb-3">
            <label>Course Code</label>
            <input type="text" name="courseCode" class="form-control" value="{{ $course->courseCode }}">
        </div>

        <div class="mb-3">
            <label>Course Name</label>
            <input type="text" name="courseName" class="form-control" value="{{ $course->courseName }}">
        </div>

        <div class="mb-3">
            <label>Author</label>
            <input type="text" name="courseAuthor" class="form-control" value="{{ $course->courseAuthor }}">
        </div>
        <div class="mb-3">
            <label>Course Image</label>
            <input type="file" name="courseImg" class="form-control">
            
            @if($course->courseImg)
                <div class="mt-2">
                    <img src="{{ asset($course->courseImg) }}" width="120">
                </div>
            @endif
        </div>
        <button class="btn btn-success">Update Course</button>
        <a href="{{ route('admin.course.module') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection