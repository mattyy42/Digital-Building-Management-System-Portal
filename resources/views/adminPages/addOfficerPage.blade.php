@extends('layouts.master')

@section('dashboard-content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Building Officer</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/admin/registerBuildingOfficer" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="firstName" placeholder="Enter First Name">
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Enter Last Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="phoneNumber">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" id="phoneNumber" placeholder="Phone Number">
                </div>
                <select class="form-control my-4 " name="role">
                    <option>Select Role</option>
                    <option value="buildingOfficer">Board of Appliance</option>
                </select>
                <select class="form-control my-4" name="bureau">
                    <option>Select Bureau</option>
                    <option value="Addis Ketema">Addis Ketema</option>
                </select>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>

    @endsection