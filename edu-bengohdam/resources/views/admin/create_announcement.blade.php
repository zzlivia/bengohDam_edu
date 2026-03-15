@extends('layouts.admin')

@section('content')

<h4 class="fw-bold mb-4">Add Announcement</h4>

<form method="POST" action="{{ route('admin.announcements.store') }}">

    @csrf

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="announcementTitle" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Details</label>
        <textarea name="announcementDetails" class="form-control" rows="4" required></textarea>
    </div>

    <button class="btn btn-primary">Save Announcement</button>

</form>

@endsection