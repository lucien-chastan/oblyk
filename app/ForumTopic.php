<?php

namespace App;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ForumTopic extends Model
{
    protected $dates = [
        'last_post'
    ];

    use ElasticquentTrait;

    public $fillable = ['label'];

    protected $mappingProperties = array(
        'label' => [
            'type' => 'string',
            "analyzer" => "standard",
        ]
    );

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