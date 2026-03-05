@extends('layouts.learner')

@section('content')

<div class="container-fluid">
<div class="row">

    <!-- Sidebar -->
    <!-- sidebar -->
        <div class="col-md-3 sidebar p-3">
            <h6 class="fw-bold mb-3">Course Modules</h6>
            @foreach($course->modules as $module)

                <div class="mb-3">

                    <div class="text-uppercase small text-muted fw-bold">
                        MODULE {{ $loop->iteration }}
                    </div>

                    <div class="fw-semibold mb-2">
                        {{ $module->moduleName }}
                    </div>

                    @foreach($module->lectures as $lecture)

                        <div class="ms-2 mb-1">
                            ○ {{ $lecture->lectName }}
                        </div>

                        {{-- SHOW MCQ IF THIS LECTURE HAS QUESTIONS --}}
                        @if($lecture->mcqs->count() > 0)
                            <a href="{{ route('module.questions', $module->moduleID) }}" class="ms-4 text-primary small text-decoration-none">
                                📝 MCQs {{ $loop->parent->iteration }}
                            </a>
                        @endif

                    @endforeach

                </div>

            @endforeach
            <a class="sidebar-link d-block mb-2" href="{{ route('course.feedback', $course->courseID) }}">
                Course Feedback
            </a>

            <a class="sidebar-link d-block" href="{{ route('course.assessment', $course->courseID) }}">
                Course Assessment
            </a>
        </div>


    <!-- Main Content -->
    <div class="col-md-9 p-4">

        <div class="text-center mb-4">
            <button class="btn btn-light shadow-sm px-4">
                Learn Local History of The Dam
            </button>
        </div>

        <h6 class="text-center mb-4">
            Course Assessment of Module 1: Introduction to the Dam
        </h6>


        {{-- If user is logged in --}}
        @auth

        <div class="card p-4 shadow-sm">

            <p>
                <b>Assessment Purpose</b><br>
                This assessment is designed to help learners reflect on what they have learned,
                share their personal memories or opinions, and demonstrate understanding of the
                dam's history and importance.
            </p>

            <p>
                <b>Assessment Format</b>
                <ol>
                    <li>Short Multiple-Choice Questions</li>
                    <li>Simple Short-Answer Questions</li>
                    <li>Reflection & Sharing Activity</li>
                </ol>
                Learners may complete the assessment at their own pace.
            </p>

            <hr>

            <form>

                <p><b>Question 1</b><br>
                What is the main purpose of a dam?</p>

                <input type="radio" name="q1"> A. xxx <br>
                <input type="radio" name="q1"> B. xxx <br>
                <input type="radio" name="q1"> C. xxx <br>
                <input type="radio" name="q1"> D. xxx <br>

                <br>

                <p><b>Question 2</b><br>
                One benefit of a dam to the community is:</p>

                <input type="radio" name="q2"> A. xxx <br>
                <input type="radio" name="q2"> B. xxx <br>
                <input type="radio" name="q2"> C. xxx <br>
                <input type="radio" name="q2"> D. xxx <br>

                <br>

                <p><b>Question 3</b><br>
                Why is the dam important to local history?</p>

                <input type="radio" name="q3"> A. xxx <br>
                <input type="radio" name="q3"> B. xxx <br>
                <input type="radio" name="q3"> C. xxx <br>
                <input type="radio" name="q3"> D. xxx <br>

                <br>

                <p><b>Question 4</b></p>

                <textarea class="form-control mb-3" rows="3"
                placeholder="In your own words, why was the dam built?"></textarea>

                <p><b>Question 5</b></p>

                <textarea class="form-control mb-3" rows="3"
                placeholder="Do you remember life before the dam, or stories told by others?"></textarea>

                <div class="text-end">
                    <button class="btn btn-success px-4">
                        Submit
                    </button>
                </div>

            </form>

        </div>

        @endauth



        {{-- If user NOT logged in --}}
        @guest

        <div class="card p-5 shadow-sm text-center">

            <div style="font-size:40px;">🔒</div>

            <p class="mt-3">
                This assessment requires you to register or sign in.
            </p>

            <a href="{{ route('login') }}" class="btn btn-primary mt-2">
                Login
            </a>

            <a href="{{ route('register') }}" class="btn btn-outline-secondary mt-2">
                Register
            </a>

        </div>

        @endguest


    </div>

</div>
</div>

@endsection