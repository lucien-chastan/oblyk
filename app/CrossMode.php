<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrossMode extends Model
{
    public function crossSections()
    {
        return $this->hasMany('App\CrossSection','mode_id', 'id');
    }
}