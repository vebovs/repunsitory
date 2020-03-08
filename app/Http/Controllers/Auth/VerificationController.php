<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use App\User;

class VerificationController extends Controller
{
    use VerifiesEmails;

    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));

        $user->email_verified_at = now();
        $user->save();

        return response()->json([
            'data' => $user,
            'id' => $request->route('id'),
            'message' => 'Email verified!'
            ]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify');
    }
}