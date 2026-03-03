<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Bengoh Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f4f6f9;
        }

        .sidebar {
            height: 100vh;
            background: #ffffff;
            border-right: 1px solid #e5e5e5;
        }

        .sidebar a {
            text-decoration: none;
            color: #333;
            display: block;
            padding: 12px 20px;
            border-radius: 8px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color: #d9e7f5;
            font-weight: 600;
        }

        .card-stat {
            border: none;
            border-radius: 12px;
            background: #e9ecef;
        }

        .card-custom {
            border-radius: 12px;
            border: none;
        }

        .topbar {
            background: white;
            border-bottom: 1px solid #e5e5e5;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- sidebar -->
        <div class="col-md-2 sidebar p-3">

            <h5 class="fw-bold mb-4">Bengoh Academy</h5>

            <a href="#" class="active">Dashboard</a>
            <a href="#">User Management</a>
            <a href="#">Course/Module Management</a>
            <a href="#">Progress</a>
            <a href="#">Announcements</a>
            <a href="#">Reports</a>

            <div class="mt-5">
                <a href="#">Settings</a>
                <a href="#">Help & Support</a>
                <a href="#">Sign Out</a>
            </div>
        </div>

        <!-- main content -->
        <div class="col-md-10 p-0">

            <!-- top navigation bar -->
            <div class="topbar d-flex justify-content-between align-items-center p-3 px-4">
                <div>
                    <strong>Languages</strong>
                </div>
                <div>
                    <span class="fw-bold">Olivia Geema</span>
                    <small class="text-muted">Administrator</small>
                </div>
            </div>

            <div class="p-4">

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
                                <li class="list-group-item">
                                    System maintenance scheduled on 03 January 2026
                                </li>
                                <li class="list-group-item">
                                    New learning resources uploaded
                                </li>
                                <li class="list-group-item">
                                    New user has just registered
                                </li>
                                <li class="list-group-item">
                                    Learner earned Historical Badge
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

                <!-- summary  -->
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

            </div>
        </div>
    </div>
</div>


<!-- JS -->
<script>
    // bar Chart
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

    // pie Chart
    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: ['Completed Modules', 'Assessment', 'MCQ'],
            datasets: [{
                data: [30, 25, 45],
                backgroundColor: ['#dc3545', '#ffc107', '#28a745']
            }]
        }
    });
</script>

</body>
</html>