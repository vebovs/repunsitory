<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pun;
use App\Http\Resources\Pun as PunResource;

class PublicPunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function popular()
    {
        $puns = Pun::select(array('users.username', 'puns.id', 'puns.title', 'puns.body', 'puns.likes'))
            ->join('users', 'puns.user_id', '=', 'users.id')
            ->orderBy('puns.likes', 'desc')
            ->orderBy('puns.created_at', 'asc')
            ->paginate(10);
            

        return PunResource::collection($puns);
    }

    public function recent() {
        $puns = Pun::select(array('users.username', 'puns.id', 'puns.title', 'puns.body', 'puns.likes'))
            ->join('users', 'puns.user_id', '=', 'users.id')
            ->orderBy('puns.created_at', 'desc')
            ->paginate(10);

        return PunResource::collection($puns);
    }
}
