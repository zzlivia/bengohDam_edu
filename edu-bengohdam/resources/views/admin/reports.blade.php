@extends('layouts.admin')

@section('content')

<h4 class="fw-bold mb-4">Report Overview</h4>

{{-- User & Enrolment --}}
<div class="card-box mb-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-bold mb-0">User & Enrolment</h6>
        <button class="btn btn-light btn-sm">⚙</button>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <p>Total Registered Users</p>
            <p>New Users</p>
            <p>Active Users</p>
            <p>Inactive Users</p>
            <p>Unregistered (guess) access account</p>
        </div>

        <div class="col-md-6 text-end">
            <p>:</p>
            <p>:</p>
            <p>:</p>
            <p>:</p>
            <p>:</p>
        </div>
    </div>

    <div class="text-end">
        <button class="btn btn-sm btn-warning">View more</button>
    </div>

</div>


{{-- Course & Module Performance --}}
<div class="card-box mb-4">

    <h6 class="fw-bold mb-3">Course & Module Performance</h6>

    <table class="table">
        <thead>
            <tr>
                <th>Course Name</th>
                <th>Module Name</th>
                <th>Enrolled</th>
                <th>Completed</th>
                <th>In Progress</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td colspan="5" class="text-center text-muted">
                    No data available
                </td>
            </tr>
        </tbody>
    </table>

    <div class="text-end">
        <button class="btn btn-sm btn-warning">View more</button>
    </div>

</div>


{{-- Assessment & MCQ --}}
<div class="card-box mb-4">

    <h6 class="fw-bold mb-3">Assessment & MCQ</h6>

    <table class="table">
        <thead>
            <tr>
                <th>Total Assessment Created</th>
                <th>Module Name</th>
                <th>Enrolled</th>
                <th>Completed</th>
                <th>In Progress</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td colspan="5" class="text-center text-muted">
                    No data available
                </td>
            </tr>
        </tbody>
    </table>

    <div class="text-end">
        <button class="btn btn-sm btn-warning">View more</button>
    </div>

</div>


{{-- Bottom Buttons --}}
<div class="text-center mt-4">

    <button class="btn btn-outline-dark me-2">
        Generate report
    </button>

    <button class="btn btn-outline-dark">
        Download report
    </button>

</div>

@endsection