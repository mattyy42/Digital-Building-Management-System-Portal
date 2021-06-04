@extends('layouts.master')

@section('dashboard-content')
<div class="card-body p-0">
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>First Name</th>
                <th>Address</th>
                <th>Construction Cost</th>
                <th>Consulting Firm Name</th>
                <th style="width: 200px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $application)
            <tr>
                <td>{{$application->id}}</td>
                <td>{{$application->applicant->first_name}}</td>
                <td>{{$application->location->city}}</td>
                <td>{{$application->locationType->estimated_cost}}</td>
                <td>{{$application->consultingFirm->name}}</td>
                <td><a class="badge bg-danger" href="{{ url('/applicant/delete/'.$application->id)}}">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection