<!DOCTYPE html>
<html>
<head>
    <title>{{ $module->moduleName }} - Questions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f5f5f5;">

<nav class="navbar navbar-light bg-white px-4 border-bottom">
    <a class="navbar-brand fw-bold" href="/">Bengoh Academy</a>
</nav>

<div class="container mt-4">

    <div class="card shadow-sm p-4">

        <h5 class="mb-3">
            Multiple Choice Questions of {{ $module->moduleName }}
        </h5>

        @if(session('result'))
            <div class="alert alert-info">
                {{ session('result') }}
            </div>
        @endif

        <form method="POST" action="{{ route('module.questions.submit', $module->moduleID) }}">
            @csrf

            @foreach($module->mcqs as $index => $question)

                <div class="mb-4">

                    <p>
                        <strong>{{ $index + 1 }}.</strong>
                        {{ $question->moduleQs }}
                    </p>

                    @foreach($question->answers as $answer)

                        <div class="form-check ms-3 mb-1">
                            <input class="form-check-input"
                                   type="radio"
                                   name="question_{{ $question->moduleQs_ID }}"
                                   value="{{ $answer->ansID }}"
                                   required>

                            <label class="form-check-label">
                                {{ $answer->ansID_text }}
                            </label>
                        </div>

                    @endforeach

                </div>

                <hr>

            @endforeach

            <div class="text-end">
                <button type="submit" class="btn btn-dark">
                    Submit
                </button>
            </div>

        </form>

    </div>

</div>

</body>
</html>