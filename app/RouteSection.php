<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RouteSection extends Model
{
    public function route(){
        return $this->hasOne('App\Route','id', 'route_id');
    }
}