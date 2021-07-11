<?php

use Illuminate\Http\Request;
//use Illuminate\Routing\Route;
use App\Http\Resources\ApplicationResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApplicantController;
use App\Application;
use App\complain;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->group(function () {
    //profile update
    Route::patch('/user/profileChange', 'api\AutheticationController@updateProfile');

    //buldingofficer
    Route::get('/buldingofficer/viewApplication', 'api\ApplicantController@viewMyApplication');
});


//admin routes   use api/

Route::get('admin/showAllApplicant', 'api\AdminController@showAllApplicant');

Route::post('/admin/registerBuildingOfficer', 'api\AdminController@registerBuildingOfficer');
Route::get('/admin/deleteBuildingOfficer/{id}', 'api\AdminController@deleteOfficer');
Route::get('/admin/showAllOfficer', 'api\AdminController@showAllBuildingOfficer');

Route::post('/admin/registerBoardOfApplicance', 'api\AdminController@registerBoard');
Route::get('/admin/deleteBoard', 'api\AdminController@registerBoard');
Route::get('/admin/showAllBoard', 'api\AdminController@showAllBoard');

//use api/register
Route::post('/register', 'api\AutheticationController@register');
Route::post('/login', 'api\AutheticationController@login');
Route::get('/logout', 'api\AutheticationController@logout')->middleware('auth:api');

//application
Route::middleware('auth:api')->group(function () {
    Route::post('/applicant/submitApplication', 'api\ApplicantController@storeApplication');
    Route::get('/applicant/viewApplication', 'api\ApplicantController@viewApplication');
    Route::get('/applicant/delete', 'api\ApplicantController@deleteApplication');
    Route::put('/applicant/update/{applicationId}','api\ApplicantController@updateApplication');
    //plan Consent
    Route::post('/applicant/submitpc','api\PlanConsentController@store');
    Route::put('/applicant/updatepc/{id}','api\PlanConsentController@updatePlanConsent');
    Route::get('/applicant/viewpc','api\PlanConsentController@applicantViewPlanConsent');
    Route::get('/bo/viewpc','api\PlanConsentController@bOViewPlanConsent');
});
//complain
Route::post('/applicant/submitComplain/{id}', 'api\ComplainController@store');
//Route::get('/boa/viewcomplain', 'api\ComplainController@index');
Route::get('/boa/viewcomplain/{id}', 'api\ComplainController@show');
//Route::get('/boa/editcomplain/{id}', 'api\ComplainController@edit');
Route::get('/boa/viewMyComplain','api\ComplainController@viewMyComplain')->middleware('auth:api');
Route::get('/boa/editcomplain/{id}','api\ComplainController@edit');
Route::get('/boa/deletecomplain','api\ComplainController@deleteComplain')->middleware('auth:api');


//plan consent 
Route::middleware('auth:api')->group(function()
    {
        Route::get('/bo/viewpc','api\PlanConsentBOController@index');
    }
);