<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymRoute extends Model
{
    public $colors = [];

    public $fillable = ['label'];

    public function sector(){
        return $this->hasOne('App\GymSector','id', 'sector_id');
    }

    /**
     * @return array
     */
    public function colors(){
        $this->colors = explode(';',$this->color);
        return $this->colors;
    }
}