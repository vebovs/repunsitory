<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;

class UserController extends Controller
{
    /**
     * @var
     */
    protected $user;

    /**
     * PunController constructor.
     */
    public function __construct(Request $request)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function destroy() {
        if(!$this->user) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be found.'
            ], 400);
        }

        if ($this->user->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'User deleted'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User could not be deleted.'
            ], 500);
        }
    }
}
