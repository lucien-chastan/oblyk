<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrossStatus extends Model
{
    public function crosses(){
        return $this->hasMany('App\Cross','status_id', 'id');
    }
}