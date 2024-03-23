<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PostRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(PostRequest $request){
        
        $userAuth = $request->only('name', 'password');

        if (Auth::attempt($userAuth)) {
            $token = $request->user()->createToken('Token Name')->accessToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]);
        }else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
