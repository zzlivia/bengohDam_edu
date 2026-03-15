@extends('layouts.admin')

@section('content')

<h4 class="fw-bold mb-4">Announcements</h4>

{{-- Filter bar --}}
<div class="card-box mb-4 d-flex justify-content-between align-items-center">

    <input type="text" class="form-control w-50" placeholder="Filter the announcements">

    <div>

        {{-- Add Announcement --}}
        <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary me-2">
            + Add Announcement
        </a>

        <button class="btn btn-light">
            ⚙
        </button>

    </div>

</div>


{{-- Announcement list --}}
@forelse($announcements as $announcement)

<div class="card-box mb-3">

    <div class="d-flex justify-content-between align-items-start">

        <div>

            <h6 class="fw-bold">
                {{ $announcement->announcementTitle }}
            </h6>

            <p class="mb-1 text-muted">
                {{ $announcement->announcementDetails }}
            </p>

            <small class="text-muted">
                Posted: {{ \Carbon\Carbon::parse($announcement->created_at)->format('d M Y') }}
            </small>

        </div>

        <div>
            <button class="btn btn-sm btn-light">View</button>
            <button class="btn btn-sm btn-warning">Review</button>
            <button class="btn btn-sm btn-light">Edit</button>
        </div>

    </div>

</div>

@empty

<div class="card-box text-center">
    <p class="text-muted mb-0">No announcements available yet.</p>
</div>

@endforelse


{{-- Home button --}}
<div class="text-center mt-4">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-light px-4">
        HOME
    </a>
</div>

@endsection