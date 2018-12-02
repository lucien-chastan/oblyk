<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymGradeLine extends Model
{
    public function grade()
    {
        return $this->hasOne('App\GymGrade', 'id', 'gym_grade_id');
    }

    /**
     * @return array
     */
    public function colors()
    {
        $this->colors = explode(';', $this->color);
        return $this->colors;
    }
}