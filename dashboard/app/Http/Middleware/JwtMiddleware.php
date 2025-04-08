<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $user = auth('api')->payload();
            $request->merge(['user' => [
                "userid" => $user->get('userid'),
                "clientid" => $user->get('clientid'),
                "personid" => $user->get('personid'),
                'fullname' => $user->get('fullname'),
                'clientname' => $user->get('clientname')
            ]]);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token not valid'], 401);
        }

        return $next($request);
    }
}
