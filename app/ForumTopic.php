<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ForumTopic extends Model
{
    protected $dates = [
        'last_post'
    ];

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function category(){
        return $this->hasOne('App\ForumCategory','id', 'category_id');
    }

    public function follows(){
        return $this->morphMany('App\Follow', 'followed');
    }

    public function posts(){
        return $this->morphMany('App\Post', 'postable');
    }

}