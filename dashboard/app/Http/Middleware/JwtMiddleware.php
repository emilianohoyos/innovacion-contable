<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $token = JWTAuth::getToken();
            $payload = JWTAuth::getPayload($token);

            // // Debug final (opcional)
            // Log::debug('JWT Payload', $payload->toArray());

            // SOLUCIÓN CLAVE: Autenticación directa
            $user = \App\Models\User::find($payload['sub']); // Usamos el ID del payload

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Usuario no existe en la base de datos'
                ], 401);
            }

            // Autenticación manual (bypass JWT temporal)
            auth('api')->setUser($user);

            // Inyecta datos al request
            $request->merge([
                'jwt_user' => [
                    'id' => $user->id,
                    'client_id' => $payload['clientid'],
                    'person_id' => $payload['personid'],
                    'name' => $payload['fullname']
                ]
            ]);

            return $next($request);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error de autenticación: ' . $e->getMessage()
            ], 401);
        }
    }
}
