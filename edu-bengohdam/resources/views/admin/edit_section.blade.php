@extends('layouts.admin')

@section('content')

<div class="container">

    <h4 class="mb-4">Edit Section</h4>

    <form action="{{ route('admin.section.update', $section->sectionID) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Section Title</label>
            <input type="text" name="section_title" class="form-control"
                   value="{{ $section->section_title }}" required>
        </div>

        <div class="mb-3">
            <label>Section Content</label>
            <textarea name="section_content" class="form-control" rows="5" required>{{ $section->section_content }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>

    </form>

</div>

@endsection