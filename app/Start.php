<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Start extends Model
{
    public function routeSections(){
        return $this->hasMany('App\RouteSection','start_id', 'id');
    }
}