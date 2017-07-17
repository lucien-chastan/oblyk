<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function likable(){
        return $this->morphTo();
    }

}