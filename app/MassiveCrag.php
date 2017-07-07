<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MassiveCrag extends Model
{
    public function massive(){
        return $this->hasOne('App\Massive','id', 'massive_id');
    }

    public function crag(){
        return $this->hasOne('App\Crag','id', 'crag_id');
    }
}