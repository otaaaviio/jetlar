<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login', 'register']]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                'user' => $user,
                'authorization' => [
                    'token' => $user->createToken('ApiToken')->plainTextToken,
                    'type' => 'bearer',
                ]
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }

    public function register(StoreUserRequest $request)
    {
        $user = User::firstOrCreate(
            ['email' => $request->email],
            ['name' => $request->name, 'password' => Hash::make($request->password)]
        );

        if (!$user->wasRecentlyCreated) {
            return response()->json(['message' => 'User already exists'], 409);
        }

        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        $cookieValue = '';
        Cookie::queue(Cookie::make('laravel_session', $cookieValue));

        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }
}
