<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function crag(){
        return $this->hasOne('App\Crag','id', 'crag_id');
    }

    public function sector(){
        return $this->hasOne('App\Sector','id', 'sector_id');
    }

    public function routeSections(){
        return $this->hasMany('App\RouteSection','route_id','id');
    }

    public function climb(){
        return $this->hasOne('App\Climb','id', 'climb_id');
    }
}