<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    public function routeSections(){
        return $this->hasMany('App\RouteSection','point_id', 'id');
    }
}