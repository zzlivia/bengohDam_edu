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
                        {{ $announcement->announcementDetails }} <br>
                        <small class="text-muted">
                            {{ $announcement->created_at->format('d M Y') }}
                        </small>
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

            <div class="chart-container">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-custom p-4">
            <h6>Resource Summary</h6>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                    Most Downloaded PDF
                    <span>
                        {{ $recentPdf->learningMaterialTitle ?? 'Not Available Yet' }}
                    </span>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    Most Viewed Video
                    <span>
                        {{ $recentVideo->learningMaterialTitle ?? 'Not Available Yet' }}
                    </span>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    Unused Materials
                    <span>
                        {{ $unusedMaterials ?? 'Not Available Yet' }}
                    </span>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    Recently Uploaded
                    <span>
                        {{ $recentMaterial->learningMaterialTitle ?? 'Not Available Yet' }}
                    </span>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const courseNames = @json($courseStats->pluck('courseName'));
const courseTotals = @json($courseStats->pluck('total'));

const ctx = document.getElementById('barChart').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: courseNames,
        datasets: [{
            label: 'Students Enrolled',
            data: courseTotals,
            backgroundColor: '#4e73df'
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                precision: 0
            }
        }
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('pieChart');

new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Completed Modules', 'PDF Materials', 'Video Materials'],
        datasets: [{
            data: [
                {{ $completedModules }},
                {{ $pdfMaterials }},
                {{ $videoMaterials }}
            ],
            backgroundColor: [
                '#dc3545',
                '#ffc107',
                '#28a745'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>
@endpush