<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use JWTAuth;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if($this->authenticate($request)) {
            return $next($request);
        } 
        return response()->json(['error' => 'Unauthorized']);
    }

    protected function authenticate($request) {
        $token = $request->cookie('token');

        try { 
            JWTAuth::setToken($token); //<-- set token and check
             if (! $claim = JWTAuth::getPayload()) {
                 return response()->json(array('message'=>'user_not_found'), 404);
             } else {
                 return true;
             }
         } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
             return response()->json(array('message'=>'token_expired'), 404);
         } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
             return response()->json(array('message'=>'token_invalid'), 404);
         } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
             return response()->json(array('message'=>'token_absent'), 404);
         }

    }
}