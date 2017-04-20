<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{

    public function users(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function descriptive(){
        return $this->morphTo();
    }
}