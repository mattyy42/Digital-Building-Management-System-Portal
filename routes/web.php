<?php

use App\Mail\WelcomeMail;
use Illuminate\Foundation\Auth\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//   $user=User::findOrFail(1);
//     return new WelcomeMail($user);
// });
// Route::get('/landing',function(){
//   return view('index') ;
// });
// Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//admin routes

//Route::get('/admin/applicant', 'AdminController@showAllApplicant');
//admin Building Officer
//Route::get('/admin/addOfficerPage', function () {
  //  return view('adminPages.addOfficerPage');
//});
//Route::get('/admin/buildingOfficer', 'AdminController@showAllBuildingOfficer')->name('buildingOfficers');
//Route::post('/admin/registerBuildingOfficer','AdminController@registerBuildingOfficer');
//Route::get('/admin/deleteOfficer/{id}','AdminController@deleteOfficer');
//admin Board
//Route::get('/admin/addBoardPage',function () {
//    return view('adminPages.addBoardPage');
//});
//Route::get('/admin/board','AdminController@showAllBoard')->name('board');
//Route::post('/admin/registerBoard','AdminController@registerBoard');
//Route::get('/admin/deleteBoard/{id}','AdminController@deleteBoard');


//Route::get('/admin/manageUser', function () {
 //   return view('adminPages.manageUser');
//});

//applicant routes
//Route::get('/applicant/applicationPage',function(){
//    return view('applicantPages.applicationForm');
//});
//Route::post('/appliant/submitAppliction/{id}','ApplicantController@storeApplication');
//Route::get('/applicant/viewApplication/{id}','ApplicantController@viewApplication');
//Route::get('/applicant/delete/{id}','ApplicantController@deleteApplication');
// Route::get('/register','') 
