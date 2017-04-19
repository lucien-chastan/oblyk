<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    public function descriptive(){
        return $this->morphTo();
    }
}