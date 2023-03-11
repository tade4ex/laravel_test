<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Email or password not valid.'
            ], Response::HTTP_UNAUTHORIZED));
        }

        return response()->json([
            'status' => true,
            'token' => Auth::user()->createToken('api_token')->plainTextToken,
            'token_type' => 'Bearer',
        ]);
    }
}
