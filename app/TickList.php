<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TickList extends Model
{
    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function route(){
        return $this->hasOne('App\Route','id', 'route_id');
    }

}