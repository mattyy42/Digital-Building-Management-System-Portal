<?php

namespace App\Http\Controllers\api;


use App\Http\Resources\UserResource;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\RoleResource;
use App\Http\Controllers\Controller;

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
        return UserResource::collection($users);
    }
    public function showAllBuildingOfficer()
    {
        $applicantId = Role::where('name', 'buildingOfficer')->get();
        $users = [];
        foreach ($applicantId as $applicant) {
            array_push($users, $applicant->user);
        }
        return UserResource::collection($users);
    }
    public function registerBuildingOfficer(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|unique:users|max:255|email',
            'password' => 'required|min:6',
            'role' => 'required',
            'bureau' => 'required'
        ]);
        $buildingOfficer = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone_number' => $request['phone_number'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $createrole = Role::create([
            'name' => $request['role'],
            'user_id' => $buildingOfficer['id'],
            'bureau' => $request['bureau'],
            // 'building_officer_id'=>$buildingOfficer->id,
        ]);

        // return redirect(route('buildingOfficers'));
        return new UserResource($buildingOfficer);
    }
    public function deleteOfficer($id)
    {
        $user = User::findOrFail($id)->delete();
        $role = Role::where('user_id', $id)->delete();
        session()->flash('message', 'The Building officer user is deleted successfully');
        return redirect(route('board'));
    }



    public function showAllBoard()
    {

        $applicantId = Role::where('name', 'boardOfAppliance')->get();
        $users = [];
        foreach ($applicantId as $applicant) {
            array_push($users, $applicant->user);
        }
        return UserResource::collection($users);
    }

    public function registerBoard(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|unique:users|max:255|email',
            'password' => 'required|min:6',
            'role' => 'required',
            'bureau' => 'required'
        ]);
        $board = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone_number' => $request['phone_number'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $createrole = Role::create([
            'name' => $request['role'],
            'user_id' => $board['id'],
            'bureau' => $request['bureau'],
        ]);

        return new UserResource($board);
    }
    public function deleteBoard($id)
    {
        $user = User::findOrFail($id)->delete();
        $role = Role::where('user_id', $id)->delete();
        session()->flash('message', 'The Board of Appliance user is deleted successfully');
        return redirect(route('board'));
    }
}
