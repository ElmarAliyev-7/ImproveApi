<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name'     => $fields['name'],
            'email'    => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('userToken')->plainTextToken;

        $response = [
            'user'  => $user,
            'token' => $token
        ];

        return response([
            'data'   => $response,
            'message' => 'User created successfully'
        ], 201);
    }

    public function logOut(Request $request)
    {
        //auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
