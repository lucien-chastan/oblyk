<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incline extends Model
{
    public function routeSections(){
        return $this->hasMany('App\RouteSection','incline_id', 'id');
    }
}