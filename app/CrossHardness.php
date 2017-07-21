<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrossHardness extends Model
{
    public function crossSections(){
        return $this->hasMany('App\CrossSection','hardness_id', 'id');
    }
}