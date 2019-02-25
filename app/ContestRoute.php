<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContestRoute extends Model
{
    public function route()
    {
        return $this->hasOne('App\GymRoute', 'id', 'route_id');
    }

    public function contest()
    {
        return $this->hasOne('App\Contest', 'id', 'contest_id');
    }
}
