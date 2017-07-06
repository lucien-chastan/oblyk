<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TopoSale extends Model
{
    public function topo(){
        return $this->hasOne('App\Topo','id', 'topo_id');
    }

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }
}