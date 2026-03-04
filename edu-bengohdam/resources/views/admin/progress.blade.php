@extends('layouts.admin')

@section('content')

<h4 class="fw-bold mb-4">Progress</h4>

<div class="row g-4">

<div class="col-md-6">
<div class="card-box">

<h6>Course Completion Progress</h6>

<div class="d-flex justify-content-around text-center mt-3">

<div>
<div class="border rounded-circle p-3">0%</div>
<small>Not Started</small>
</div>

<div>
<div class="border rounded-circle p-3">75%</div>
<small>In Progress</small>
</div>

<div>
<div class="border rounded-circle p-3">25%</div>
<small>Completed</small>
</div>

</div>

</div>
</div>

<div class="col-md-6">
<div class="card-box">

<h6>Assessment Completion Progress</h6>

<div class="d-flex justify-content-around text-center mt-3">

<div>
<div class="border rounded-circle p-3">0%</div>
<small>Not Started</small>
</div>

<div>
<div class="border rounded-circle p-3">75%</div>
<small>Pending</small>
</div>

<div>
<div class="border rounded-circle p-3">25%</div>
<small>Completed</small>
</div>

</div>

</div>
</div>

</div>

@endsection