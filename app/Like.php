<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
     * @var string
     */
    protected $table = 'likes';

    /**
     * @var array
     */
    protected $guarded = [];
}
