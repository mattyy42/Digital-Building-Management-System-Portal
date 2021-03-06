<?php

use Illuminate\Http\Request;
//use Illuminate\Routing\Route;
use App\Http\Resources\ApplicationResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApplicantController;
use App\Application;
use App\complain;
use App\Events\ApplicationAssignedEvenet;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::get('/test', function ()
// {
//   event(new ApplicationAssignedEvenet('test message'));

// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->group(function () {
    //profile update
   

    //buldingofficer
    
});


//admin routes   use api/
Route::get('admin/getUserById/{id}','api\AdminController@showUser');

Route::get('admin/showAllApplicant', 'api\AdminController@showAllApplicant');

Route::post('/admin/registerBuildingOfficer', 'api\AdminController@registerBuildingOfficer');
Route::delete('/admin/deleteBuildingOfficer/{id}', 'api\AdminController@deleteOfficer');
Route::get('/admin/showAllOfficer', 'api\AdminController@showAllBuildingOfficer');
Route::put('/admin/editBO','api\AdminController@edit');

Route::post('/admin/registerBoardOfApplicance', 'api\AdminController@registerBoard');
Route::get('/admin/deleteBoard', 'api\AdminController@registerBoard');
Route::get('/admin/showAllBoard', 'api\AdminController@showAllBoard');
Route::put('/admin/editBA','api\AdminController@edit');

// fetch burau
Route::get('/getAllBureau','api\BureauController@allBureau');
Route::post('/addBureau','api\BureauController@createBureau');
Route::delete('/deleteBureau/{id}','api\BureauController@delete');
Route::get('/getBureau/{id}','api\BureauController@showBureau');
Route::put('/editBureau','api\BureauController@edit');
//use api/register
Route::post('/register', 'api\AutheticationController@register');
Route::post('/login', 'api\AutheticationController@login');
Route::get('/logout', 'api\AutheticationController@logout');

//application
Route::middleware('auth:api')->group(function () {
    //profile
    Route::put('/user/profileChange', 'api\AutheticationController@updateProfile');

    Route::post('/applicant/submitApplication', 'api\ApplicantController@storeApplication');
    Route::get('/applicant/viewApplication', 'api\ApplicantController@viewApplication');
    Route::get('/applicant/delete', 'api\ApplicantController@deleteApplication');
    Route::put('/applicant/update/{applicationId}','api\ApplicantController@updateApplication');

    Route::post('/applicant/submitComplain/{id}', 'api\ComplainController@store');
    Route::get('/applicant/viewComplain','api\ComplainController@showComplain');
    Route::get('/applicant/deleteComplain/{id}','api\ComplainController@complainDelete');
    //plan Consent
    Route::post('/applicant/submitpc','api\PlanConsentController@store');
    Route::put('/applicant/updatepc/{id}','api\PlanConsentController@updatePlanConsent');
    Route::get('/applicant/viewpc','api\PlanConsentController@applicantViewPlanConsent');
    
    Route::get('/bo/pc','api\PlanConsentController@bOViewPlanConsent');
    Route::get('/bo/acceptPc/{id}','api\PlanConsentController@acceptPlanConsent');
    Route::get('/bo/rejectPc/{id}','api\PlanConsentController@rejectPlanConsent');
    Route::post('/bo/addComment/{id}','api\PlanConsentController@commentAdd');
    //Building officer application
    Route::get('/buildingofficer/viewApplication', 'api\ApplicantController@viewMyApplication');
    Route::get('/buildingOfficer/acceptApp/{id}','api\ApplicantController@acceptApplication');
    Route::get('/buildingOfficer/rejectApp/{id}','api\ApplicantController@rejectApplication');
    Route::post('/buildingOfficer/addComment/{id}','api\ApplicantController@commentApplication');
    
    //board of applicance routes

    Route::get('/boa/viewMyComplain','api\ComplainController@BoaViewComplain');
    Route::get('/boa/acceptPc/{id}','api\ComplainController@acceptComplain');
    Route::get('/boa/rejectPc/{id}','api\ComplainController@rejectComplain');
    Route::post('/boa/addComment/{id}','api\ComplainController@commentAdd');
});
//complain




Route::get('/boa/editcomplain/{id}','api\ComplainController@edit');
Route::get('/boa/deletecomplain','api\ComplainController@deleteComplain')->middleware('auth:api');


//plan consent 
Route::middleware('auth:api')->group(function()
    {
        Route::get('/bo/viewpc','api\PlanConsentBOController@index');
    }
);