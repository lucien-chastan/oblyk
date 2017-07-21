<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrossSection extends Model
{
    public function cross(){
        return $this->hasOne('App\Cross','id', 'cross_id');
    }

    public function crossMode(){
        return $this->hasOne('App\CrossMode','id', 'mode_id');
    }

    public function crossHardness(){
        return $this->hasOne('App\CrossHardness','id', 'hardness_id');
    }

    public function routeSection(){
        return $this->hasOne('App\RouteSection','id', 'route_section_id');
    }
}