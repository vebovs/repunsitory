<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use App\Like;
use App\Pun;

class UserController extends Controller
{
    /**
     * @var
     */
    protected $user;

    /**
     * UserController constructor.
     */
    public function __construct(Request $request)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function liked() {
        if(!$this->user) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be found.'
            ], 400);
        }

        $liked_puns = Pun::select(array('likes.pun_id as id', 'puns.title', 'puns.body'))
            ->join('likes', 'puns.id', '=', 'likes.pun_id')
            ->where('likes.user_id', $this->user->id)
            ->orderBy('likes.created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'liked_puns' => $liked_puns
        ]);
        
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
