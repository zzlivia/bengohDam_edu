<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Community Stories - Bengoh Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .hero-section {
            background: #8ec6df;
            border-radius: 15px;
            padding: 60px 20px;
            text-align: center;
            margin-bottom: 40px;
        }

        .story-card {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .btn-read {
            background-color: #28a745;
            color: #fff;
        }

        .btn-read:hover {
            background-color: #218838;
            color: #fff;
        }

        footer {
            margin-top: 50px;
            padding: 20px;
            background: #fff;
            border-top: 2px solid #00aaff;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white px-4 border-bottom">
    <a class="navbar-brand fw-bold" href="/homepage">
        Bengoh Academy
    </a>

    <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
            <li class="nav-item mx-2"><a class="nav-link" href="/homepage">Home</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="/courses">Courses</a></li>
            <li class="nav-item mx-2"><a class="nav-link active fw-bold" href="#">Community Stories</a></li>
        </ul>
    </div>
</nav>

<div class="container mt-4">

    {{-- Hero Section --}}
    <div class="hero-section">
        <h4 class="fw-bold">Bengoh Academy</h4>
        <h2 class="fw-bold mt-3">Community Stories</h2>
    </div>

    {{-- Stories List --}}
    <div class="story-card d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fw-bold">Community 1 Name</h6>
            <p class="small mb-0">Community 1 Story</p>
        </div>
        <a href="#" class="btn btn-read btn-sm px-4">READ</a>
    </div>

    <div class="story-card d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fw-bold">Community 2 Name</h6>
            <p class="small mb-0">Community 2 Story</p>
        </div>
        <a href="#" class="btn btn-read btn-sm px-4">READ</a>
    </div>

    <div class="story-card d-flex justify-content-between align-items-center">
        <div>
            <h6 class="fw-bold">Community 3 Name</h6>
            <p class="small mb-0">Community 3 Story</p>
        </div>
        <a href="#" class="btn btn-read btn-sm px-4">READ</a>
    </div>

    {{-- Navigation Buttons --}}
    <div class="text-center mt-4">
        <a href="/homepage" class="btn btn-success px-4">HOME</a>
        <button class="btn btn-success px-4">NEXT</button>
    </div>

</div>

<footer>
    <div class="container d-flex gap-4 small fw-bold">
        <a href="#">Terms</a>
        <a href="#">Privacy</a>
        <a href="#">Contact</a>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>