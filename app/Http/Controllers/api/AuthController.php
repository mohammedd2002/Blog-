<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $valData = $request->validated();
        $user = User::create($valData);
        $data['token'] = $user->createToken('RegisterToken')->plainTextToken;
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        return ApiResponse::sendResponse(201, 'User Created Successfully', $data);
    }

    public function login(LoginRequest $request)
    {
        $valData = $request->validated();
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user($valData);
            $data['token'] = $user->createToken('loginToken')->plainTextToken;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            return ApiResponse::sendResponse(200, 'Login Successfully', $data);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ApiResponse::sendResponse(200, 'Logged Out Successfully', []);
    }
}
