<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function linkable(){
        return $this->morphTo();
    }
}