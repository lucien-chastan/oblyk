<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    public function search(){
        return $this->morphOne('App\Search', 'searchable');
    }
}