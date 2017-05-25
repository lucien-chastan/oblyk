<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RainExposure extends Model
{
    public function sectors(){
        return $this->hasMany('App\Sector','rain_id', 'id');
    }
}