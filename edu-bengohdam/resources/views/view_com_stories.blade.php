@extends('layouts.learner')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/community_stories.css') }}">
@endsection

@section('content')
<div class="container mt-4">
    <div class="hero-section">
        <h4 class="fw-bold">Bengoh Academy</h4>
        <h2 class="fw-bold mt-3">Community Stories</h2>
    </div>
    {{-- list of community stories --}}
    @foreach($stories as $story)
        <div class="story-card d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fw-bold">{{ $story->community_name }}</h6>
                <p class="small mb-0">{{ $story->title }}</p>
            </div>
            <a href="#" class="btn btn-read btn-sm px-4">READ</a>
        </div>
    @endforeach
    <div class="text-center mt-4">
        <a href="/homepage" class="btn btn-success px-4">HOME</a>
        <button class="btn btn-success px-4">NEXT</button>
    </div>
</div>
@endsection