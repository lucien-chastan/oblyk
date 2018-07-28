<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function descriptions(){
        return $this->morphMany('App\Description', 'descriptive');
    }

    /**
     * @param int $size [1300,200,100,50]
     * @return string
     */
    public function bandeau($size = 1300){
        return file_exists(storage_path('app/public/articles/' . $size . '/article-' . $this->id . '.jpg')) ? '/storage/articles/' . $size . '/article-' . $this->id . '.jpg' : '/img/default-article-bandeau.jpg';
    }

    public function articleCrags(){
        return $this->hasMany('App\ArticleCrag','article_id','id');
    }

    public function articleTopos(){
        return $this->hasMany('App\ArticleTopo','article_id','id');
    }

    public function enrichedAuthor(){
        return $this->hasOne('App\Author','id','author_id');
    }

    /**
     * @param bool $absolute
     * @return string
     */
    public function url($absolute = true) {
        return $this->webUrl($this->id, $this->label, $absolute);
    }

    /**
     * @param $id
     * @param $label
     * @param bool $absolute
     * @return string
     */
    static function webUrl($id, $label, $absolute = true) {
        return route(
            'articlePage',
            [
                'article_id' => $id,
                'article_label' => (str_slug($label) != '') ? str_slug($label) : 'article'
            ],
            $absolute
        );
    }
}
