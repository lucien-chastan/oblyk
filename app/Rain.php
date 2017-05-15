<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rain extends Model
{
    public function sectors(){
        return $this->hasMany('App\Sector','rain_id', 'id');
    }
}