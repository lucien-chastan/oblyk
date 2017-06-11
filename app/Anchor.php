<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anchor extends Model
{
    public function routeSections(){
        return $this->hasMany('App\RouteSection','anchor_id', 'id');
    }
}