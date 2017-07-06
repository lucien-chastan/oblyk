<?php

namespace App;

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
        'password', 'remember_token',
    ];

    public function crags(){
        return $this->hasMany('App\Crag','user_id', 'id');
    }

    public function parkings(){
        return $this->hasMany('App\Parking','user_id', 'id');
    }

    public function sectors(){
        return $this->hasMany('App\Sector','user_id', 'id');
    }

    public function routes(){
        return $this->hasMany('App\Route','user_id', 'id');
    }

    public function lexiques(){
        return $this->hasMany('App\Lexique','user_id', 'id');
    }

    public function descriptions(){
        return $this->hasMany('App\Description','user_id', 'id');
    }

    public function albums(){
        return $this->hasMany('App\Album','user_id', 'id');
    }

    public function photos(){
        return $this->hasMany('App\Photo','user_id', 'id');
    }

    public function sales(){
        return $this->hasMany('App\Sale','user_id', 'id');
    }

    public function topos(){
        return $this->hasMany('App\Topo','user_id', 'id');
    }
}
