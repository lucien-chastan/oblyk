<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GapGrade extends Model
{
    public function spreadable(){
        return $this->morphTo();
    }
}