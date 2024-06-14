<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!auth()->check()) {
            $resp = [
                'status' => false,
                'data' => '',
                'message' => 'unauthorized',
                'errorCode' => ''
            ];

            return response()->json($resp, 401);

        }
        return $next($request);
    }
}
