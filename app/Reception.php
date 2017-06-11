<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    public function routeSections(){
        return $this->hasMany('App\RouteSection','reception_id', 'id');
    }
}