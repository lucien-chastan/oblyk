<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function photos(){
        return $this->hasMany('App\Photo','album_id', 'id');
    }

}