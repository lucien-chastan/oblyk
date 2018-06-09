<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymRoute extends Model
{

    public $fillable = ['label'];

    public function sector(){
        return $this->hasOne('App\GymSector','id', 'sector_id');
    }

}