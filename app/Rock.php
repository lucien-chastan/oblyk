<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rock extends Model
{
    public function crags(){
        return $this->hasMany('App\Crag','rock_id', 'id');
    }
}