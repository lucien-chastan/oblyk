<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sun extends Model
{
    public function sectors(){
        return $this->hasMany('App\Sector','sun_id', 'id');
    }
}