<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('apiJwt', ['except' => ['login']]);
    }
    public function login(Request $request)
    {
        $email = $request['matricula'];
        $password = $request['password'];
        if (!$token = Auth::attempt(['matricula'=> $email, 'password'=> $password])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    public function me()
    {
      
        return response()->json(auth()->user());
    }

    public function logout()
    { 
       Auth::logout();
       return response()->json(['message' => 'Successfully logged out']);
    }
   
    
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user'=> auth()->user()
        ]);
    }
}
