<?php

namespace App\Http\Controllers;


class ApiAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * login: Provides the login throigh the credential token
     * @return \Illuminate\Http\JsonResponse
     */
    public function login() {
        $credentials = request(['email', 'password']);

        if(!$token = \auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'],401);
        }

        return $this->generateToken($token);
    }


    /**
     * logout: Logs out a this user
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        \auth('api')->logout();
        return response()->json(['message' => "Logged out"]);
    }

    /**
     * refresh: refresh the time session
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->generateToken(\auth('api')->refresh());
    }

    /**
     * generateToken: Creates the user token based in its credentials
     * @param $token: credential token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function generateToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => \auth('api')->factory()->getTTL() * 60,
        ]);
    }
}
