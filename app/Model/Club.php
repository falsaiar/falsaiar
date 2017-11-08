<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use Sluggable;
    //
     public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    //
    public function members()
    {
        return $this->hasMany('App\Model\ClubMember');
    }
}
