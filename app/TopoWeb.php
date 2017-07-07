<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TopoWeb extends Model
{
    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function crag(){
        return $this->hasOne('App\Crag','crag_id', 'id');
    }

}