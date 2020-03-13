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
     * PunController constructor.
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

        $liked = Like::where('user_id', $this->user->id)->get();

        $pun_ids = array();
        foreach($liked as $like) {
            array_push($pun_ids, $like->pun_id);
        }

        $puns = Pun::findMany($pun_ids);

        $liked_puns = array();
        foreach($puns as $pun) {
            array_push($liked_puns, [
                "id" => $pun->id,
                "title" => $pun->title,
                "body" => $pun->body
            ]);
        }

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
