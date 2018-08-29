<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        User::create([
            'username' => $request->json('username'),
            'email' => $request->json('email'),
            'password' => bcrypt($request->json('password'))
        ]);
    }

    public function login(Request $request)
    {
        try {
            $token = JWTAuth::attempt($request->only('email', 'password'), [
                'exp' => Carbon::now()->addWeek()->timestamp,
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Could not authenticate',
            ], 500);
        }

        if (!$token) {
            return response()->json([
                'error' => 'Could not authenticate',
            ], 401);
        }

        return response()->json(compact('token'));
    }
}
