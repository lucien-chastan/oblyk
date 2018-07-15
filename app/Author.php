<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    /**
     * @param int $size [1300,200,100,50]
     * @return string
     */
    public function picture($size = 1300){
        return file_exists(storage_path('app/public/authors/' . $size . '/author-' . $this->id . '.png')) ? '/storage/articles/' . $size . '/article-' . $this->id . '.jpg' : '/img/default-article-bandeau.jpg';
    }

    public function articles(){
        return $this->hasMany('App\Article','author_id','id');
    }

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }

}