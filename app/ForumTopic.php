<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ForumTopic extends Model
{
    protected $dates = [
        'last_post'
    ];

    public $fillable = ['label'];

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
            'topicPage',
            [
                'topic_id' => $id,
                'topic_label' => (str_slug($label) != '') ? str_slug($label) : 'sujet'
            ],
            $absolute
        );
    }
}