<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrossUser extends Model
{
    public function cross(){
        return $this->hasOne('App\Cross','id', 'cross_id');
    }

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

}