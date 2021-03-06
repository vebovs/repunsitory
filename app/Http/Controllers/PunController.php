<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use App\Pun;
use App\Like;
use App\Http\Resources\Pun as PunResource;
use App\Http\Controllers\PublicPunController;

class PunController extends Controller
{

    /**
     * @var
     */
    protected $user;

    private $ppc_service;

    /**
     * PunController constructor.
     */
    public function __construct(Request $request)
    {
        $this->user = JWTAuth::parseToken()->authenticate(); //Check if user is authenticated before performing any actions
        $this->ppc_service = new PublicPunController();
    }

    //Gets all puns created by user
    public function index() {
        $puns = $this->user->puns()->orderBy('created_at', 'desc')->get(['id', 'title', 'body', 'likes'])->toArray();

        return $puns;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);
    
        $pun = new Pun();
        $pun->title = $request->title;
        $pun->body = $request->body;
    
        if ($this->user->puns()->save($pun))
            return response()->json([
                'success' => true,
                'pun' => $pun
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, pun could not be added.'
            ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get pun
        $pun = $this->user->tasks()->find($id);

        if(!$pun) {
            return response()->json([
                'success' => false,
                'message' => 'no pun found'
            ], 400);
        }

        return $pun;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pun = $this->user->puns()->find($id);

        if (!$pun) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, pun with id ' . $id . ' cannot be found.'
            ], 400);
        }
    
        $updated = $pun->fill($request->all())->save();
    
        if ($updated) {
            return response()->json([
                'success' => true,
                'pun' => $pun
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, pun could not be updated.'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pun = $this->user->puns()->find($id);

        if (!$pun) {
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

    //Allowes users to like puns
    public function like($id) {
    
        //Checks if user already has liked this pun
        $like = Like::select('*')->where([
            ['user_email', '=', $this->user->email],
            ['pun_id', '=', $id]
        ]);

        if($like->count()) {
            return response()->json([
                'success' => false,
                'message' => 'Already liked'
            ], 400);
        }

        $pun = Pun::find($id);
        $updated = $pun->increment('likes'); //increments the puns likes count by 1

        $like = new Like();
        $like->user_email = $this->user->email;
        $like->pun_id = $id;
        $this->user->likes()->save($like); //Adds the pun to the users liked puns

        if ($updated) {
            return response()->json([
                'success' => true,
                'pun' => $pun
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, pun could not be updated.'
            ], 500);
        }

    }
}
