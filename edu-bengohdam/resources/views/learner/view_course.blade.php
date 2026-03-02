<!DOCTYPE html>
<html>
<head>
    <title>{{ $course->courseName }} - Bengoh Academy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f3f3f3;">
<div class="container mt-4">
    <!-- Course Banner Image -->
    <div class="text-center mb-4">
        <img src="{{ asset($course->courseImg) }}"
             class="img-fluid rounded"
             style="max-height:350px;">
    </div>
    <!-- Course Info -->
    <div class="row mb-4">
        <div class="col-md-9">
            <h4>{{ $course->courseName }}</h4>

            <p class="text-muted">
                {{ $course->courseDesc }}
            </p>
        </div>
        <div class="col-md-3 text-end">
            <small class="text-muted">
                Author: {{ $course->courseAuthor }}
            </small>
        </div>
    </div>
    <!-- Modules -->
    <div class="row">
        @foreach($modules as $index => $module)
        <div class="col-md-6 mb-4">
            <div class="card p-3 shadow-sm">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">{{ $module->moduleName }}</h6>
                    <strong>0{{ $index + 1 }}</strong>
                </div>

                <ul class="list-unstyled">
                    <li>Lecture 1</li>
                    <li>Lecture 2</li>
                    <li>Lecture 3</li>
                </ul>

            </div>
        </div>
        @endforeach
    </div>

    <!-- Bottom Buttons -->
    <div class="d-flex justify-content-between mt-4">
        <a href="#" class="btn btn-outline-secondary">
            View Course Feedback
        </a>
        <button class="btn btn-primary">
            ENROL
        </button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>