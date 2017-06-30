<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function album(){
        return $this->hasOne('App\Album','id', 'album_id');
    }

    public function illustrable(){
        return $this->morphTo();
    }
}