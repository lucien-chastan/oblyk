<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function descriptions(){
        return $this->morphMany('App\Description', 'descriptive');
    }
}