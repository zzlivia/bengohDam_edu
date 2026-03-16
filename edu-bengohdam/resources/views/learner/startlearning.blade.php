@extends('layouts.learner')

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
        <!-- Sidebar -->
        @include('partials.course-sidebar')
            <!-- Main Content -->
            <div class="col-md-9">
                <div class="content-section">
                    <h4 class="fw-bold">
                        {{ $course->courseTitle }}
                    </h4>
                    <div class="video-box my-3 d-flex align-items-center justify-content-center">
                        <span class="text-muted">Video Placeholder</span>
                    </div>
                    @if($section)
                        <h5>{{ $section->section_title }}</h5>

                        @if($section->section_type == 'text')
                            <p>{{ $section->section_content }}</p>
                        @endif

                        @if($section->section_type == 'pdf')
                            <iframe src="{{ asset('storage/'.$section->section_file) }}" width="100%" height="400"></iframe>
                        @endif

                    @endif
                    <div class="d-flex justify-content-between mt-4">
                        <button class="btn btn-outline-secondary btn-nav"> Previous </button>
                        <button class="btn btn-primary btn-nav"> Next </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection