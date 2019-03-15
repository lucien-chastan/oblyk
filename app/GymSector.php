<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymSector extends Model
{
    public $fillable = ['label'];

    public function gym() {
        return $this->hasOne('App\Gym','id', 'gym_id');
    }

    public function routes() {
        return $this->hasMany('App\GymRoute', 'sector_id', 'id');
    }

    public function room() {
        return $this->hasOne('App\GymRoom','id', 'room_id');
    }

    public function crosses()
    {
        return $this->hasMany('App\IndoorCross', 'sector_id', 'id');
    }

    public function hasPicture()
    {
        return file_exists(storage_path('app/public/gyms/sectors/1300/sector-' . $this->id . '.jpg'));
    }

    public function picture($size = 200)
    {
        return $this->hasPicture() ? '/storage/gyms/sectors/' . $size . '/sector-' . $this->id . '.jpg' : '';
    }
}
