@extends('layouts.admin')

@section('content')

<h4 class="fw-bold mb-4">Announcements</h4>

{{-- Filter bar --}}
<div class="card-box mb-4 d-flex justify-content-between align-items-center">

    <input type="text" class="form-control w-50" placeholder="Filter the announcements">

    <button class="btn btn-light">
        ⚙
    </button>

</div>


{{-- Announcement list --}}
<div class="card-box mb-3">

    <div class="d-flex justify-content-between align-items-start">

        <div>
            <h6 class="fw-bold">Pending Module Review</h6>
            <p class="mb-1 text-muted">
                2 modules are in draft and require approval before publishing
            </p>
            <small class="text-muted">Priority:</small>
        </div>

        <div>
            <button class="btn btn-sm btn-light">View</button>
            <button class="btn btn-sm btn-warning">Review</button>
            <button class="btn btn-sm btn-light">Edit</button>
        </div>

    </div>

</div>


<div class="card-box mb-3">

    <div class="d-flex justify-content-between align-items-start">

        <div>
            <h6 class="fw-bold">New Resources Uploaded</h6>
            <p class="mb-1 text-muted">
                3 PDFs were uploaded and are awaiting verification
            </p>
            <small class="text-muted">Priority:</small>
        </div>

        <div>
            <button class="btn btn-sm btn-light">View</button>
            <button class="btn btn-sm btn-warning">Review</button>
            <button class="btn btn-sm btn-light">Edit</button>
        </div>

    </div>

</div>


<div class="card-box mb-3">

    <div class="d-flex justify-content-between align-items-start">

        <div>
            <h6 class="fw-bold">Caption in Video Need to be Checked</h6>
            <p class="mb-1 text-muted">
                3 videos are missing subtitles
            </p>
            <small class="text-muted">Priority:</small>
        </div>

        <div>
            <button class="btn btn-sm btn-light">View</button>
            <button class="btn btn-sm btn-warning">Review</button>
            <button class="btn btn-sm btn-light">Edit</button>
        </div>

    </div>

</div>


<div class="card-box mb-3">

    <div class="d-flex justify-content-between align-items-start">

        <div>
            <h6 class="fw-bold">MCQs are ready for activation</h6>
            <p class="mb-1 text-muted">
                MCQs for Module Marketing in a Local Homestay is created and ready to be published.
            </p>
            <small class="text-muted">Priority:</small>
        </div>

        <div>
            <button class="btn btn-sm btn-light">View</button>
            <button class="btn btn-sm btn-warning">Review</button>
            <button class="btn btn-sm btn-light">Edit</button>
        </div>

    </div>

</div>


<div class="card-box mb-3">

    <div class="d-flex justify-content-between align-items-start">

        <div>
            <h6 class="fw-bold">Assessment Results are Available</h6>
            <p class="mb-1 text-muted">
                Learners can review their assessment results
            </p>
            <small class="text-muted">Priority:</small>
        </div>

        <div>
            <button class="btn btn-sm btn-light">View</button>
            <button class="btn btn-sm btn-warning">Review</button>
            <button class="btn btn-sm btn-light">Edit</button>
        </div>

    </div>

</div>


{{-- Home button --}}
<div class="text-center mt-4">

    <a href="{{ route('admin.dashboard') }}" class="btn btn-light px-4">
        HOME
    </a>

</div>

@endsection