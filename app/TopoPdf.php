<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TopoPdf extends Model
{
    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function crag(){
        return $this->hasOne('App\Crag','id', 'crag_id');
    }

    public function search(){
        return $this->morphOne('App\Search', 'searchable');
    }
}