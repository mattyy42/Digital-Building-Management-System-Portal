@extends('layouts.master')

@section('dashboard-content')
<div class="card-body p-0">
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Phone Number</th>
                <th style="width: 200px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $application)
            <tr>
                <td>{{$application->id}}</td>
                <td>{{$application->applicant->first_name}}</td>
                <td><button class="badge bg-danger">Delete</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection