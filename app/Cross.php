<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cross extends Model
{

    protected $dates = [
        'release_at'
    ];

    public function route(){
        return $this->hasOne('App\Route','id', 'route_id');
    }

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function crossSections(){
        return $this->hasMany('App\CrossSection','cross_id', 'id');
    }

    public function crossUsers(){
        return $this->hasMany('App\CrossUser','cross_id', 'id');
    }

    public function description(){
        return $this->hasOne('App\Description', 'cross_id', 'id');
    }

    public function crossStatus(){
        return $this->hasOne('App\CrossStatus','id', 'status_id');
    }

    public function crossMode(){
        return $this->hasOne('App\CrossMode','id', 'mode_id');
    }

    public function crossHardness(){
        return $this->hasOne('App\CrossHardness','id', 'hardness_id');
    }
}