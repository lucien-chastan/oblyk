<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Climb extends Model
{
    public function crags(){
        return $this->hasMany('App\Route','climb_id', 'id');
    }
}