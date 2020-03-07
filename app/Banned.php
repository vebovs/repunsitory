<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banned extends Model
{
    /**
     * @var string
     */
    protected $table = 'banned';

    /**
     * @var array
     */
    protected $guarded = [];
}
