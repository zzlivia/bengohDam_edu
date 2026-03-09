@extends('layouts.admin') {{-- layout template of admin --}}

@section('content') {{-- content section --}}

<!-- status cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card card-stat p-3 text-center">
            <h6>Total Users</h6>
            <h3>5</h3>
            <small class="text-muted">Registered Users</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3 text-center">
            <h6>Total Courses</h6>
            <h3>4</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3 text-center">
            <h6>Assessments Completed</h6>
            <h3>3</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3 text-center">
            <h6>Total Enrollment</h6>
            <h3>5</h3>
        </div>
    </div>
</div>

<!-- charts and announcements -->
<div class="row mb-4">
    <div class="col-md-7">
        <div class="card card-custom p-4">
            <h6>Most Course Taken</h6>
            <canvas id="barChart" height="120"></canvas>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card card-custom p-4">
            <h6>Announcements</h6>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">System maintenance scheduled on 03 January 2026</li>
                <li class="list-group-item">New learning resources uploaded</li>
                <li class="list-group-item">New user has just registered</li>
                <li class="list-group-item">Learner earned Historical Badge</li>
            </ul>
        </div>
    </div>
</div>

<!-- summary -->
<div class="row">
    <div class="col-md-6">
        <div class="card card-custom p-4">
            <h6>Overall Analysis on Modules</h6>
            <canvas id="pieChart" height="200"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-custom p-4">
            <h6>Resource Summary</h6>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                    Most Downloaded PDF
                    <span>Learn Local History of The Dam</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    Most Viewed Video
                    <span>Learn Local History of The Dam</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    Unused Materials
                    <span>Learn Local History of The Dam</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    Recently Uploaded
                    <span>Marketing a Local Homestay</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
    // bar chart
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['01','02','03','04','05','06','07'],
            datasets: [{
                label: 'Courses',
                data: [6,5,7,8,6,9,8],
                backgroundColor: '#198754'
            }]
        }
    });
    // pie chart
    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: ['Completed Modules', 'Assessment', 'MCQ'],
            datasets: [{
                data: [30,25,45],
                backgroundColor: ['#dc3545','#ffc107','#28a745']
            }]
        }
    });
</script>
@endpush