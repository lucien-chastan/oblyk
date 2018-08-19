<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleCrag extends Model
{
    public function article(){
        return $this->hasOne('App\Article','id', 'article_id');
    }

    public function crag(){
        return $this->hasOne('App\Crag','id', 'crag_id');
    }
}