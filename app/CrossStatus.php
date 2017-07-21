<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrossStatus extends Model
{
    public function crossSections(){
        return $this->hasMany('App\CrossSection','status_id', 'id');
    }
}