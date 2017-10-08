<?php

namespace App;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    use ElasticquentTrait;

    public $fillable = ['label', 'contents'];

    protected $mappingProperties = array(
        'label' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'contents' => [
            'type' => 'string',
            "analyzer" => "standard",
        ]
    );
}