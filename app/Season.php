<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    public function seasontable(){
        return $this->morphTo();
    }
}