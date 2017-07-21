<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cross extends Model
{
    public function route(){
        return $this->hasOne('App\Route','id', 'route_id');
    }

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function crossSections(){
        return $this->hasMany('App\CrossSection','cross_id', 'id');
    }
}