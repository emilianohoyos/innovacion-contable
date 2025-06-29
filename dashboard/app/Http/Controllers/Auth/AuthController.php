<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // User login
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        try {
            if (! $token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
            $user = auth('api')->user();
            $token = JWTAuth::claims([
                "userid" => $user->contactInfo->user_id,
                "clientid" => $user->contactInfo->client_id,
                "personid" => $user->contactInfo->id,
                'fullname' => $user->contactInfo->firstname . " " . $user->contactInfo->lastname,
                'clientname' => $user->contactInfo->client->company_name
            ])->fromUser($user);

            return response()->json(["token" => $token,  'fullname' => $user->contactInfo->firstname . " " . $user->contactInfo->lastname, 'clientname' => $user->contactInfo->client->company_name]);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
