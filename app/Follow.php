<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function followed(){
        return $this->morphTo();
    }
}