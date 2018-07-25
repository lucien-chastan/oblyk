<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleTopo extends Model
{
    public function article(){
        return $this->hasOne('App\Article','id', 'article_id');
    }

    public function topo(){
        return $this->hasOne('App\Topo','id', 'topo_id');
    }
}