<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'provider', 'provider_id',
    ];

    public function profile()
    {
        return $this->hasMany('App\Model\Profile');
    }

    public function status()
    {
        return $this->hasMany('App\Model\Status');
    }

    public function post()
    {
        return $this->hasMany('App\Model\Post');
    }

    public function comment()
    {
        return $this->hasMany('App\Model\Comment');
    }

    public function hobbies()
    {
        return $this->hasMany('App\Model\Hobby');
    }
}
