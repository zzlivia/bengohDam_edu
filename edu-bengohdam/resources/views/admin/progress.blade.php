@extends('layouts.admin')

@section('content')

<h4 class="fw-bold mb-4">Progress</h4>
<div class="row g-4">
    <div class="col-md-6">
        <div class="card-box">
            <h6>Course Completion Progress</h6>
            <div class="d-flex justify-content-around text-center mt-3">
                <div>
                    <div class="border rounded-circle p-3">{{ $notStartedPercent }}%</div>
                    <small>Not Started</small>
                </div>
                <div>
                    <div class="border rounded-circle p-3">{{ $inProgressPercent }}%</div>
                    <small>In Progress</small>
                </div>
                <div>
                    <div class="border rounded-circle p-3">{{ $completedPercent }}%</div>
                    <small>Completed</small>
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-6">
        <div class="card-box">
            <h6>Assessment Completion Progress</h6>
            <div class="d-flex justify-content-around text-center mt-3">
                <div>
                    <div class="progress-circle" style="--value: {{ $notStartedPercent ?? 0 }}">
                        <span>{{ $notStartedPercent ?? 0 }}%</span>
                    </div>
                    <small>Not Started</small>
                </div>
                <div>
                    <div class="progress-circle red" style="--value: {{ $inProgressPercent ?? 0 }}">
                        <span>{{ $inProgressPercent ?? 0 }}%</span>
                    </div>
                    <small>In Progress</small>
                </div>
                <div>
                    <div class="progress-circle dark-red" style="--value: {{ $completedPercent ?? 0 }}">
                        <span>{{ $completedPercent ?? 0 }}%</span>
                    </div>
                    <small>Completed</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection