<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
     public function user()
    {
    	return $this->belongsTo('App\Model\User');
    }

    public function comment()
    {
        return $this->hasMany('App\Model\Comment');
    }
}
