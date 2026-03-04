@extends('layouts.admin')

@section('content')

<h4 class="fw-bold mb-4">Summary</h4>

<div class="row mb-4">

    <div class="col-md-3">
        <div class="card-box text-center">
            <h6>Total Users</h6>
            <h2>{{ $totalUsers }}</h2>
            <small>Engaged in this week</small>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-box text-center">
            <h6>Total Users</h6>
            <h2>{{ $totalUsers }}</h2>
            <small>Engaged in this week</small>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-box text-center">
            <h6>Total Users</h6>
            <h2>{{ $totalUsers }}</h2>
            <small>Engaged in this week</small>
        </div>
    </div>

</div>


{{-- Search + Buttons --}}
<div class="d-flex justify-content-between align-items-center mb-3">

    <input type="text" class="form-control w-50" placeholder="Search User">

    <div>
        <button class="btn btn-primary">Add User Manually</button>
        <button class="btn btn-danger">Remove User</button>
    </div>

</div>


{{-- User Table --}}
<div class="card-box">

    <table class="table">

        <thead>
            <tr>
                <th>Name</th>
                <th>Email Address</th>
                <th>Age</th>
                <th>Engagement</th>
                <th>Rank</th>
                <th>Completed Courses</th>
            </tr>
        </thead>

        <tbody>

        @forelse($users as $user)

        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
        </tr>

        @empty

        <tr>
            <td colspan="6" class="text-center">No users found</td>
        </tr>

        @endforelse

        </tbody>

    </table>

</div>


<div class="text-center mt-5">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
        Home
    </a>
</div>

@endsection