@extends('layouts.admin')

@section('content')

<div class="container-fluid">

<div class="row">

<!-- LEFT COLUMN -->
<div class="col-md-6">

    <h6 class="fw-bold mb-3">General System Settings</h6>

    <div class="mb-3 d-flex align-items-center">
        <label class="me-3">Default Language:</label>
        <select class="form-select w-auto">
            <option>Default</option>
            <option>English</option>
            <option>Malay</option>
        </select>
    </div>

    <div class="mb-4 d-flex align-items-center">
        <label class="me-3">Notifications:</label>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox">
        </div>
    </div>


    <h6 class="fw-bold mb-3">User & Access Settings</h6>

    <div class="mb-3">
        <label class="me-3">User Registration:</label>

        <button class="btn btn-sm btn-danger">Enable</button>
        <button class="btn btn-sm btn-light border">Disable</button>
    </div>

    <div class="mb-4">
        <label class="me-3">Guest Access:</label>

        <button class="btn btn-sm btn-danger">Enable</button>
        <button class="btn btn-sm btn-light border">Disable</button>
    </div>


    <h6 class="fw-bold mb-3">Accessibility</h6>

    <div class="mb-3">
        <label class="me-3">Enable Text-to-Speech:</label>

        <button class="btn btn-sm btn-danger">Enable</button>
        <button class="btn btn-sm btn-light border">Disable</button>
    </div>

    <div class="mb-3 d-flex align-items-center">
        <label class="me-3">Font Size:</label>

        <select class="form-select w-auto">
            <option>Default</option>
            <option>Small</option>
            <option>Medium</option>
            <option>Large</option>
        </select>
    </div>

</div>


<!-- RIGHT COLUMN -->
<div class="col-md-6">

    <h6 class="fw-bold mb-3">Announcement Settings</h6>

    <div class="mb-4 d-flex align-items-center">
        <label class="me-3">Announcements:</label>

        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" checked>
        </div>
    </div>


    <h6 class="fw-bold mb-3">Report Settings</h6>

    <div class="mb-4">
        <label class="me-3">Export format:</label>

        <button class="btn btn-sm btn-danger">PDF</button>
        <button class="btn btn-sm btn-danger">Excel</button>
    </div>


    <h6 class="fw-bold mb-3">Content Upload & Media Settings</h6>

    <div class="mb-3">
        <label class="me-3">Allowed File Types:</label>

        <button class="btn btn-sm btn-danger">PDF</button>
        <button class="btn btn-sm btn-danger">MP4</button>
    </div>

    <div class="mb-3 d-flex align-items-center">
        <label class="me-3">Maximum file size:</label>

        <input type="text" class="form-control w-50">
    </div>

    <div class="mb-3 d-flex align-items-center">
        <label class="me-3">Video resolution limit:</label>

        <input type="text" class="form-control w-50">
    </div>

</div>

</div>


<!-- SAVE BUTTON -->
<div class="text-center mt-4">
    <button class="btn btn-outline-dark btn-sm">Save Changes</button>
</div>

</div>

@endsection