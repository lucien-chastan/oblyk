<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumGeneralCategory extends Model
{
    public function categories(){
        return $this->hasMany('App\ForumCategory','general_category_id', 'id');
    }
}