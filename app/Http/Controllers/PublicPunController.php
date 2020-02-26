<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
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
        //Get puns
        $puns = Pun::select()->paginate(10);

        //Return collection of puns as a resource
        return PunResource::collection($puns);
    }

    public function recent() {
        $puns = Pun::orderBy('created_at', 'desc')->paginate(10);
        return PunResource::collection($puns);
    }
}
