{{-- sidebar of course, module, progress, assessment, mcqs, and leaderboards --}}
<div class="col-md-3 sidebar p-3">
    <h6 class="fw-bold mb-3">Course Modules</h6>
    @foreach($course->modules as $module)
    <div class="mb-3">
        <div class="text-uppercase small text-muted fw-bold"> MODULE {{ $loop->iteration }} </div>
        <div class="fw-semibold mb-2"> {{ $module->moduleName }} </div>
        {{-- Lectures --}}
        @foreach($module->lectures as $lecture)
            <div class="ms-2 mb-1"> ○ {{ $lecture->lectName }} </div>
            {{-- Sections --}}
            @foreach($lecture->sections as $section)
                <div class="ms-4 small text-muted"> • {{ $section->sectionTitle }} </div>
            @endforeach
            {{-- MCQ --}}
            @if($lecture->mcqs->count() > 0)
                <a href="{{ route('module.questions', $module->moduleID) }}" class="ms-4 text-primary small text-decoration-none d-block"> MCQs </a>
            @endif
        @endforeach
    </div>
    @endforeach
    <a class="sidebar-link d-block mb-2" href="{{ route('course.feedback', $course->courseID) }}">Course Feedback</a>
    <a class="sidebar-link d-block mb-2" href="{{ route('course.assessment', $course->courseID) }}">Course Assessment</a>
    <a class="sidebar-link d-block mb-2" href="{{ route('course.progress', $course->courseID) }}">Progress</a>
    <a class="sidebar-link d-block" href="{{ route('leaderboards') }}">Leaderboards</a>
</div>