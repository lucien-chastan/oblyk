<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymGrade extends Model
{
    public function gym()
    {
        return $this->hasOne('App\Gym', 'id', 'gym_id');
    }

    public function gradeLines()
    {
        return$this->hasMany('App\GymGradeLine', 'gym_grade_id', 'id');
    }
}