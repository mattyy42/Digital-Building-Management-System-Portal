<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AutheticationController extends Controller
{
    public function register(Request $request)
    {
        $validator = validate($request(), [
            'email' => 'required|unique:users',
            'first_name' => 'required', 'string',
            'last_name' => 'required', 'string',
            'password' => 'required|min:6', 'confirmed',
            'phone_number' => 'required|unique:users'
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $validator->message()->toArray()
                ],
                500
            );
        }
        $createUser = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone_number' => $request['phone_number'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $createrole = Role::create([
            'name' => 'applicant',
            'user_id' => $createUser['id'],
        ]);

        $token = $createUser->createToken('Personal Access Token')->accessToken;
        return response()->json(['success' => true, 'message' => 'Registration is successful'], 200);
    }
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('Personal Access Token')->accessToken;
            return response()->json([
                'token' => $token,
                'user' => auth()->user()
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Incorrect Email or Password please try again'], 401);
        }
    }

    public function updateProfile()
    {
        $user = auth()->user();
        $this->validate(request(), [
            'email' => 'required|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|min:6',
            'phone_number' => 'required|unique:users'
        ]);
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
