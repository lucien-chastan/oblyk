<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    public $fillable = ['label', 'definition'];

    public function user() {
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function versions() {
        return $this->morphMany('App\Version', 'versionnable');
    }
}
