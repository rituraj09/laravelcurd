<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tel extends Model
{
    //
    protected $table    	= 'tels';
    public $timestamps = false;
    protected $guarded =['_token'];
}
