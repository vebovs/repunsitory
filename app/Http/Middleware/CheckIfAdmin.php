<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->admin = JWTAuth::parseToken()->authenticate();

        if($this->admin->role != 2) {
            return response()->json([
                'success' => false,
                'message' => 'Not an administrator'
            ], 400);
        }

        return $next($request);
    }
}
