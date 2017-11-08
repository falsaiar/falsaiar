<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ClubMember extends Model
{
    //
     public function club()
    {
    	return $this->belongsTo('App\Model\Club');
    }
}
