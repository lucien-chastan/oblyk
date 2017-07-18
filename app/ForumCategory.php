<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    public function topics(){
        return $this->hasMany('App\ForumTopic','category_id', 'id');
    }

    public function generalCategory(){
        return $this->hasOne('App\ForumGeneralCategory','id', 'general_category_id');
    }
}