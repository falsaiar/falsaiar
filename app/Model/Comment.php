<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
     public function status()
    {
    	return $this->belongsTo('App\Model\Status');
    }

     public function user()
    {
    	return $this->belongsTo('App\Model\User');
    }

     public function comment()
    {
    	return $this->belongsTo('App\Model\Comment');
    }
}
