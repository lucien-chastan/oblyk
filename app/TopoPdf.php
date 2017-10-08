<?php

namespace App;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TopoPdf extends Model
{

    use ElasticquentTrait;

    public $fillable = ['label', 'author', 'description'];

    protected $mappingProperties = array(
        'label' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'description' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'editor' => [
            'type' => 'string',
            "analyzer" => "standard",
        ]
    );

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function crag(){
        return $this->hasOne('App\Crag','id', 'crag_id');
    }

}