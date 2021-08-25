<?php

namespace App\Http\Controllers\api;


use App\Http\Resources\UserResource;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\RoleResource;
use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function showUser($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }
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
        $applicantId = Role::where('name', 'BO')->get();
        $users = [];
        foreach ($applicantId as $applicant) {
            array_push($users, $applicant->user);
        }
        return UserResource::collection($users);
    }
    public function registerBuildingOfficer(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|max:255|string',
            'last_name' => 'required',
            'phone_number' => 'required|min:10',
            'email' => 'required|unique:users|max:255|email',
            'password' => 'required|min:6',
            'role' => 'required',
            'bureau' => 'required'
        ]);
        $buildingOfficer =  User::create([
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
        ]);
        $email_data = array(
            'first_name' => $request['first_name'],
            'email' => $request['email'],
            'password'=>$request['password']
        );
       // Mail::to($buildingOfficer->email)->send(new WelcomeMail($email_data));
       
        return new UserResource($buildingOfficer);
    }
    public function deleteOfficer($id)
    {
        $user = User::findOrFail($id)->delete();
        $role = Role::where('user_id', $id)->delete();
        //session()->flash('message', 'The Building officer user is deleted successfully');
        return response()->json([
            'message'=>'building officer id deleted successfully'
        ]);
    }

    public function edit(Request $request)
    {
        $data = $request->validate([
            'id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($request->input('id'))],
            'password' => 'required|min:6',
            'role' => 'required',
            'bureau' => 'required'
        ]);
        $editedUser = User::findOrFail($request->id);
        $editedUser->update(
            $data
        );
        return new UserResource($editedUser);
    }

    public function showAllBoard()
    {
        $applicantId = Role::where('name', 'BA')->get();
        $users = [];
        foreach ($applicantId as $applicant) {
            array_push($users, $applicant->user);
        }
        return UserResource::collection($users);
    }

    public function registerBoard(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
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
        $email_data = array(
            'first_name' => $request['first_name'],
            'email' => $request['email'],
            'password'=>$request['password']
        );
        //Mail::to($request['email'])->send(new WelcomeMail($email_data));
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
