<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthenticateApi
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user('sanctum')) {
            return response()->json(['message' => 'No autenticado'], 401);
        }

        return $next($request);
    }
}