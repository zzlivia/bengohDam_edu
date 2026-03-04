<!DOCTYPE html>
<html>
<head>
<title>Progress - Bengoh Academy</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#eaf1f7;
}

.sidebar{
height:100vh;
background:white;
padding:20px;
border-right:1px solid #ddd;
}

.sidebar a{
display:block;
padding:10px;
border-radius:8px;
text-decoration:none;
color:#333;
margin-bottom:6px;
}

.sidebar a.active,
.sidebar a:hover{
background:#d6e4f5;
font-weight:500;
}

.card-box{
background:white;
border-radius:12px;
padding:20px;
box-shadow:0 3px 8px rgba(0,0,0,0.05);
}

.progress-circle{
width:70px;
height:70px;
border-radius:50%;
border:6px solid #ddd;
display:flex;
align-items:center;
justify-content:center;
font-weight:600;
margin:auto;
}

.red{
border-color:#e53935;
}

.blue{
border-color:#1e88e5;
}

.gray{
border-color:#ccc;
}

.bar{
height:6px;
background:#ddd;
border-radius:5px;
position:relative;
margin-top:20px;
}

.bar-fill{
height:6px;
background:#e53935;
width:80%;
border-radius:5px;
}

.score-circle{
width:80px;
height:80px;
border-radius:50%;
border:6px solid #ccc;
display:flex;
align-items:center;
justify-content:center;
margin-left:auto;
font-weight:bold;
}

</style>
</head>

<body>

<div class="container-fluid">

<div class="row">

<!-- SIDEBAR -->

<div class="col-md-2 sidebar">

<h5 class="fw-bold mb-4">Bengoh Academy</h5>

<a href="{{ route('admin.dashboard') }}">Dashboard</a>

<a href="{{ route('admin.user.management') }}">User Management</a>

<a href="{{ route('admin.course.module') }}">Course/Module Management</a>

<a href="{{ route('admin.progress') }}"
class="{{ request()->routeIs('admin.progress') ? 'active' : '' }}">
Progress
</a>

<a href="#">Announcements</a>

<a href="#">Reports</a>

<div class="mt-5">
<a href="#">Settings</a>
<a href="#">Help & Support</a>
<a href="#">Sign Out</a>
</div>

</div>

<!-- MAIN CONTENT -->

<div class="col-md-10 p-4">

<div class="row g-4">

<!-- COURSE COMPLETION -->

<div class="col-md-6">
<div class="card-box">

<h6 class="fw-bold mb-3">Course Completion Progress</h6>

<div class="d-flex justify-content-around text-center">

<div>
<div class="progress-circle gray">0%</div>
<small>Not Started</small>
</div>

<div>
<div class="progress-circle red">75%</div>
<small>In Progress</small>
</div>

<div>
<div class="progress-circle red">25%</div>
<small>Completed</small>
</div>

</div>

</div>
</div>

<!-- ASSESSMENT -->

<div class="col-md-6">
<div class="card-box">

<h6 class="fw-bold mb-3">Assessment Completion Progress</h6>

<div class="d-flex justify-content-around text-center">

<div>
<div class="progress-circle gray">0%</div>
<small>Not Started</small>
</div>

<div>
<div class="progress-circle red">75%</div>
<small>Pending</small>
</div>

<div>
<div class="progress-circle red">25%</div>
<small>Completed</small>
</div>

</div>

</div>
</div>

<!-- MCQ -->

<div class="col-md-6">
<div class="card-box">

<h6 class="fw-bold mb-3">MCQs Attempt Progress</h6>

<div class="d-flex justify-content-around text-center">

<div>
<div class="progress-circle blue">0%</div>
<small>Not Attempted</small>
</div>

<div>
<div class="progress-circle red">75%</div>
<small>Assigned</small>
</div>

<div>
<div class="progress-circle red">25%</div>
<small>Attempted</small>
</div>

</div>

</div>
</div>

<!-- MCQ SCORE -->

<div class="col-md-6">
<div class="card-box">

<h6 class="fw-bold mb-3">Average MCQ Score</h6>

<div class="d-flex align-items-center">

<span class="me-3 fw-bold">80%</span>

<div class="bar flex-grow-1">
<div class="bar-fill"></div>
</div>

<div class="score-circle ms-3">69%</div>

</div>

</div>
</div>

</div>

</div>

</div>

</div>

</body>
</html>