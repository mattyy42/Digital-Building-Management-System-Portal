@extends('layouts.master')

@section('dashboard-content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Manage Applicant</h3>

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
                        <th>Phone Number</th>
                        <th style="width: 200px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->first_name}} {{$user->last_name}}</td>
                        <td>{{$user->phone_number}}</td>
                        <td><button class="badge bg-danger">Delete</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @endsection