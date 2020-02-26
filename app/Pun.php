<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pun extends Model
{
     /**
     * @var string
     */
    protected $table = 'puns';

    /**
     * @var array
     */
    protected $guarded = [];
}
