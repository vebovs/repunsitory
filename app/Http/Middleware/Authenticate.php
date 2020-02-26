<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use JWTAuth;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        /*if ($this->authenticate($request, $guards) === 'authentication_error') {
            return response()->json(['error'=>'Unauthorized']);
        }*/

        if($this->authenticated($request)) {
            return $next($request);
        } 
        return response()->json(['error' => 'Unauthorized']);



        //return $next($request);
    }

    protected function authenticated($request) {
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

    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }

        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }

        return 'authentication_error';
    }
}