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


//buldingofficer
Route::get('/buldingofficer/viewApplication/{id}','api\ApplicantController@viewMyApplication');

//admin routes   use api/

Route::get('admin/showAllApplicant','api\AdminController@showAllApplicant');

Route::post('/admin/registerBuildingOfficer','api\AdminController@registerBuildingOfficer');
Route::get('/admin/deleteBuildingOfficer','api\AdminController@deleteOfficer');
Route::get('/admin/showAllOfficer','api\AdminController@showAllBuildingOfficer');

Route::post('/admin/registerBoardOfApplicance','api\AdminController@registerBoard');
Route::get('/admin/deleteBoard','api\AdminController@registerBoard');
Route::get('/admin/showAllBoard','api\AdminController@showAllBoard');

//use api/register
Route::post('/register','api\AutheticationController@register');
Route::post('/login','api\AutheticationController@login');
Route::post('/logout','api\AutheticationController@logout')->middleware('auth:api');
//application 
Route::post('/applicant/submitApplication/{id}','api\ApplicantController@storeApplication');
Route::get('/applicant/viewApplication/{id}', function()
{
    return new ApplicationResource(Application::first());
});
Route::get('/applicant/delete/{id}','api\ApplicantController@deleteApplication');
//complain
Route::post('/applicant/submitComplain/{id}','api\ComplainController@store');
Route::get('/boa/viewcomplain','api\ComplainController@index');
Route::get('/boa/viewcomplain/{id}','api\ComplainController@show');
Route::get('/boa/editcomplain/{id}','api\ComplainController@edit');