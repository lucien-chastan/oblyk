<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Elasticquent\ElasticquentTrait;

class Word extends Model
{
    use ElasticquentTrait;

    public $fillable = ['label', 'definition'];

    protected $mappingProperties = array(
        'label' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'definition' => [
            'type' => 'string',
            "analyzer" => "standard",
        ]
    );

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

}