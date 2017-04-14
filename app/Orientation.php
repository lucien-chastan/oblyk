<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orientation extends Model
{
    public function orientable(){
        return $this->morphTo();
    }
}