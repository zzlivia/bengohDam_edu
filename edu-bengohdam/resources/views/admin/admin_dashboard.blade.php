@extends('layouts.admin') {{-- layout template of admin from admin.blade.php --}}

@section('content') {{-- content section --}}

<!-- status cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card card-stat p-3 text-center">
            <h6>Total Users</h6>
            <h3>{{ $totalUsers }}</h3>
            <small class="text-muted">Registered Users</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3 text-center">
            <h6>Total Courses</h6>
            <h3>{{ $totalCourses }}</h3>
            <small class="text-muted">Offered Courses</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3 text-center">
            <h6>Total Modules</h6>
            <h3>{{ $totalModules }}</h3>
            <small class="text-muted">Available Modules</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3 text-center">
            <h6>Total Lectures</h6>
            <h3>{{ $totalLectures }}</h3>
            <small class="text-muted">Available Lectures</small>
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
                @foreach($announcements as $announcement)
                    <li class="list-group-item">
                        <strong>{{ $announcement->announcementTitle }}</strong><br>
                        {{ $announcement->announcementDetails }}
                    </li>
                @endforeach
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