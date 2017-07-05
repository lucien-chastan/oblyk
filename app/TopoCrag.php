<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TopoCrag extends Model
{
    public function topo(){
        return $this->hasOne('App\Topo','id', 'topo_id');
    }

    public function crag(){
        return $this->hasOne('App\Crag','id', 'crag_id');
    }
}