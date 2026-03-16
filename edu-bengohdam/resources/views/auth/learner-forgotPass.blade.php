@extends('layouts.app')

@section('content')

<h3 class="forgot-title">Forgot your password?</h3>
    <form method="POST" action="{{ route('request.reset') }}">
        @csrf
        <input 
            type="email" 
            name="userEmail"
            class="forgot-input"
            placeholder="Enter your email address"
            required
        >
        <br>
        <button type="submit" class="submit-btn"> SUBMIT </button>
    </form>
@endsection