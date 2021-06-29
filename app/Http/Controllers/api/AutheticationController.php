<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

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

        $token = $createUser->createToken('Personal Access Token')->accessToken;
        return response()->json(['token' => $token], 200);
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
            return response()->json(['error' => 'Incorrect Email or Password please try again'], 401);
        }
    }
    public function logout(Request $request)
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
