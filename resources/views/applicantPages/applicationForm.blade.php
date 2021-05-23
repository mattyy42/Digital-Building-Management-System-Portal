@extends('layouts.master')

@section('dashboard-content')
@if($errors->any())
{!! implode('', $errors->all('
<div class="alert alert-danger">
    <strong>failed!</strong>:message
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
'))!!}
@endif
<div class="card p-2 bg-secondary">
    <h3>Application Form</h3>
</div>
<form class="needs-validation" action="{{ url('/appliant/submitAppliction/'.auth()->user()->id )}}" method="post">
    @csrf
    <div class="col-12">
        <h4>Construction Location </h4>
        <hr>
    </div>
    <div class="form-row">
        <div class="col-md-4 mb-2">
            <label for="validationCustom01">City</label>
            <input type="text" class="form-control" name="city" placeholder="Enter City">

        </div>
        <div class="col-md-4 mb-3">
            <label for="validationCustom02">Sub City</label>
            <input type="text" class="form-control" name="sub_city" placeholder="Enter Sub City">
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationCustomUsername">Wereda/Kebele</label>
            <div class="input-group">
                <input type="text" class="form-control" name="wereda" placeholder="Enter Wereda / Kebele" aria-describedby="inputGroupPrepend">
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationSpecial">Special name for Location </label>
            <div class="input-group">
                <input type="text" class="form-control" name="special_name" placeholder="Enter Special name for the location" aria-describedby="inputGroupPrepend">
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationHouse">House Number</label>
            <div class="input-group">
                <input type="text" class="form-control" name="house_number" placeholder="Enter House Number">
            </div>
        </div>
    </div>
    <div class="col-12">
        <h4>Construction Type </h4>
        <hr>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-3">
            <select class="form-control my-4" name="constructionType">
                <option>Type of Construction</option>
                <option value="newConstruction">New Construction</option>
                <option value="Improvement">Improvement</option>
                <option value="Expansion">Expansion</option>
                <option value="Construction permit extension">Construction permit extension</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <select class="form-control my-4" name="constructionCondition">
                <option>The condition of the construction</option>
                <option value="At once">At once</option>
                <option value="Step by step">Step by step</option>
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationestimatedCost">Estimated Cost</label>
            <div class="input-group">
                <input type="number" class="form-control" placeholder="Enter the Estimated Cost" name="estimatedCost">
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationnumberOfFloor">Number of Floor</label>
            <div class="input-group">
                <input type="number" class="form-control" placeholder="Enter the Number of Floor" name="floorNumber">
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationnumberOfFloorground">Number of Floor Below the Ground</label>
            <div class="input-group">
                <input type="number" class="form-control" placeholder="Enter the Number of Floor of the Ground" name="groundFloorNumber">
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationbuildingHeight">Height of Building Above the Ground</label>
            <div class="input-group">
                <input type="number" class="form-control" placeholder="Enter the Height of the building in meter" name="buildingHeight">
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationbuildingHeightBelow">Height of Building Below the Ground</label>
            <div class="input-group">
                <input type="number" class="form-control" placeholder="Enter the Height of the Building Below the Ground" name="groundBuildingHeight">
            </div>
        </div>
    </div>
    <div class="col-12">
        <h4>Consulting Firm </h4>
        <hr>
    </div>
    <div class="form-row">
        <div class="col-md-4 mb-3">
            <label for="validationname">Name</label>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter the name of the Consulting Firm" name="consultingFirmName">
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationlevel">Level</label>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter the level of the Consulting Firm" name="consultingFirmLevel">
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationphone">Phone Number</label>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter the Phone Number of the Consulting Firm" name="consultingFirmPhone">
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <label for="validationaddress">Address</label>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter the Address of the Consulting Firm" name="consultingFirmAddress">
            </div>
        </div>
    </div>


    <button class="btn btn-success" type="submit">Submit form</button>
</form>

<!-- <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script> -->
@endsection