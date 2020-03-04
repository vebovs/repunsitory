<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use App\User;
use App\Pun;

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

        if($this->admin->role != 2) {
            $this->admin = null;
        }
    }

    public function index() {

        if(!$this->admin) {
            return response()->json([
                'success' => false,
                'message' => 'Not an administrator'
            ], 400);
        }

        $users = User::all();
        return response()->json(
            [
                'status' => 'success',
                'users' => $users->toArray(),
                'role' => $this->admin->role
            ], 200);
    }

    public function destroyUser($id) {

        if(!$this->admin) {
            return response()->json([
                'success' => false,
                'message' => 'Not an administrator'
            ], 400);
        }

        $user = User::find($id);

        if(!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user with id ' . $id . ' cannot be found.'
            ], 400);
        }

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

        if(!$this->admin) {
            return response()->json([
                'success' => false,
                'message' => 'Not an administrator'
            ], 400);
        }

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
