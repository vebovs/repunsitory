<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use App\User;
use App\Pun;
use App\Banned;

class AdminController extends Controller
{

    /**
     * @var
     */
    protected $admin;

    /**
     * AdminController constructor.
     */
    public function __construct(Request $request)
    {
        $this->admin = JWTAuth::parseToken()->authenticate();
    }

    public function index() {
        $users = User::all();
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray(),
                'role' => $this->admin->role
            ], 200);
    }

    public function destroyUser($id) {
        $user = User::find($id);

        if(!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user with id ' . $id . ' cannot be found.'
            ], 400);
        }

        $banned = new Banned();
        $banned->user_id = $user->id;
        $banned->email = $user->email;
        $banned->save();

        if ($user->delete()) {
            return response()->json([
                'success' => true,
                'id' => $id
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User could not be deleted.'
            ], 500);
        }
    }

    public function destroyPun($id) {
        $pun = Pun::find($id);

        if(!$pun) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, pun with id ' . $id . ' cannot be found.'
            ], 400);
        }

        if ($pun->delete()) {
            return response()->json([
                'success' => true,
                'id' => $id
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pun could not be deleted.'
            ], 500);
        }
    }
}
