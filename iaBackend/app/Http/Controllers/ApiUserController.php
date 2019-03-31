<?php

namespace App\Http\Controllers;


class ApiUserController extends Controller
{
    public function me() {
        if(auth('api')->user()) {
            return response()->json(auth('api')->user(), 200);
        }
        return response()->json(['error' => 'Unauthorized'],401);
    }
}
