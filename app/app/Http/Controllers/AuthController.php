<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        $token = Auth::attempt($data);

        if (!$token) {
            return response()->json([
                'message' => 'Email or password is incorrect'
            ], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'data' => [
                'user' => Auth::user(),
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer'
                ]
            ]
        ], 200);
    }
}
