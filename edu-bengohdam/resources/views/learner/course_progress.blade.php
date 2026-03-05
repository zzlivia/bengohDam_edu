@extends('layouts.learner')

@section('content')

<div class="container mt-4">

<h4>Course Progress</h4>

<table class="table table-bordered">

<tr>
<th>Activity</th>
<th>Status</th>
<th>Progress</th>
</tr>

@foreach($progress as $p)

<tr>
<td>{{ $p->progressName }}</td>
<td>{{ $p->progressStatus }}</td>
<td>{{ $p->completionProgress }}%</td>
</tr>

@endforeach

</table>

</div>

@endsection