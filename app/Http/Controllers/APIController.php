<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Cookie;
use Validator;
use App\Banned;

class APIController extends Controller
{
    /**
     * @var bool
     */
    public $loginAfterSignUp = false;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ], 400);
        }
        

        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }

        $user = User::find(Auth::user()->id);

        return response()->json([
            'success' => true,
            'token' => $token,
            'username' => $user->username,
            'role' => $user->role
        ])->cookie('token', $token);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate($request->cookie('token'));

            $cookie = Cookie::forget('token');

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ])->cookie($cookie);

        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function register(Request $request)
    {   
        
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:users|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->all()
            ], 400);
        }

        if(Banned::where('email', $request->email)) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, this email has been blacklisted'
            ], 400);
        }

        
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }

        return response()->json([
            'success'   =>  true
        ], 200);
    }

    public function refresh(Request $request) {
        $user = JWTAuth::toUser($request->cookie('token'));

        if(!$user) {
            return response()->json([
                'success' => false
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $request->cookie('token'),
            'username' => $user->username,
            'role' => $user->role
        ]);
    }
}