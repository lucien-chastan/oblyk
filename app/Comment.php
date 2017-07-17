<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function commentable(){
        return $this->morphTo();
    }
}