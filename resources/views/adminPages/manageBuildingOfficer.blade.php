@extends('layouts.master')

@section('dashboard-content')
@if(session()->has('message'))
<div class="alert alert-success">
    <strong>Success!</strong> {{session()->get('message')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@elseif(session()->has('error'))
<div class="alert alert-danger">
    <strong>failed!</strong> {{session()->get('error')}}
</div>
@endif
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title r-5">Manage Building Officer</h3>
            <a href="/admin/addOfficerPage" class="mx-5 bg-primary">Add Building Officer</a>
            <div class="card-tools">
                <ul class="pagination pagination-sm float-right">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Bureau</th>
                        <th>Phone Number</th>
                        <th style="width: 200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->first_name}} {{$user->last_name}}</td>
                        <td>{{$user->role->bureau}}</td>
                        <td>{{$user->phone_number}}</td>
                        <td>
                            <div>
                                <button class="badge bg-warning">Edit</button>
                                <a class="badge bg-danger" href="{{ url('/admin/deleteOfficer/'.$user->id)}}">Delete</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @endsection