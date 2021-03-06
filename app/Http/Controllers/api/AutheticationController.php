<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Mail\WelcomeMailApplicant;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AutheticationController extends Controller
{
    public function register(Request $data)
    {
        $data->validate([
            'email' => 'required|unique:users',
            'first_name' => 'required', 'string',
            'last_name' => 'required', 'string',
            'password' => 'required|min:6', 'confirmed',
            'phone_number' => 'required|unique:users'
        ]);
        $createUser = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $createrole = Role::create([
            'name' => 'applicant',
            'user_id' => $createUser['id'],
        ]);
        $email_data = array(
            'first_name' => $data['first_name'],
            'email' => $data['email'],
           
        );
        //Mail::to($data['email'])->send(new WelcomeMailApplicant($email_data));
        return response()->json(['sucess' => true, 'msg' => 'Registration is successfull'], 200);
    }
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('Personal Access Token');
            return response()->json([
                'success' => true,
                'token' => $token->accessToken,
                'user' => new UserResource(auth()->user()),
            ], 200);
        } else {
            return response()->json(['success' => false, 'error' => 'Incorrect Email or Password please try again'], 401);
        }
    }

    public function updateProfile()
    {
        $user = auth()->user()->id;
        // Rule::unique('users')->ignore($id)
        $this->validate(request(), [
            'email' => ['required', 'email', 'max:255',],
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|min:6|confirmed',
            'phone_number' => 'required|unique:users'
        ]);
        $user=User::findOrFail($user);
        $user->first_name = request('first_name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->last_name = request('last_name');
        $user->phone_number = request('phone_number');
        $user->save();

        return new UserResource($user);
    }

    public function logout()
    {
        if (auth()->check()) {
            auth()->user()->token()->revoke();
            return response()->json([
                'success' => true,
                'message' => 'Logout successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unable to Logout'
            ]);
        }
    }
}
