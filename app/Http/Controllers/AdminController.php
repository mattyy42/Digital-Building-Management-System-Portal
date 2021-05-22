<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function showAllApplicant()
    {
        $applicantId = Role::where('name', 'applicant')->get();
        $users = [];
        foreach ($applicantId as $applicant) {
            array_push($users, $applicant->user);
        }
        return view('adminPages.manageApplicant', compact('users'));
    }
    public function showAllBuildingOfficer()
    {
        $applicantId = Role::where('name', 'buildingOfficer')->get();
        $users = [];
        foreach ($applicantId as $applicant) {
            array_push($users, $applicant->user);
        }
        return view('adminPages.manageBuildingOfficer', compact('users'));
    }
    public function registerBuildingOfficer(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|unique:users|max:255|email',
            'password'=>'required|min:6',
            'role'=>'required'
        ]);
        $buildingOfficer=User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone_number' => $request['phone_number'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $createrole=Role::create([
            'name'=>$request['role'],
            'user_id' =>$buildingOfficer['id'],
        ]);
        
        return redirect(route('buildingOfficers'));
    }
    public function showAllBoard(){
        
        $applicantId = Role::where('name', 'boardOfAppliance')->get();
        $users = [];
        foreach ($applicantId as $applicant) {
            array_push($users, $applicant->user);
        }
        return view('adminPages.manageBoard', compact('users'));
    }

    public function registerBoard(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|unique:users|max:255|email',
            'password'=>'required|min:6',
            'role'=>'required'
        ]);
        $buildingOfficer=User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone_number' => $request['phone_number'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $createrole=Role::create([
            'name'=>$request['role'],
            'user_id' =>$buildingOfficer['id'],
        ]);
        
        return redirect(route('board'));
    }
}
