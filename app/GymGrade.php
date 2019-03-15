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
        return $this->hasMany('App\GymGradeLine', 'gym_grade_id', 'id');
    }

    public function updateDifficultySystem()
    {
        if ($this->difficulty_system == 0) {

            // Hold and tag as a same color
            $this->difficulty_is_tag_color = true;
            $this->difficulty_is_hold_color = true;
            $this->has_hold_color = true;

        } elseif ($this->difficulty_system == 1) {

            // tag color give difficulty
            $this->difficulty_is_tag_color = true;
            $this->difficulty_is_hold_color = false;
            $this->has_hold_color = true;

        } elseif ($this->difficulty_system == 2) {

            // difficulty is given by grade, no tag and no particular color for holds
            $this->difficulty_is_tag_color = false;
            $this->difficulty_is_hold_color = false;
            $this->has_hold_color = true;

        } elseif ($this->difficulty_system == 3) {

            // difficulty is given by tag but holds not coloured
            $this->difficulty_is_tag_color = true;
            $this->difficulty_is_hold_color = false;
            $this->has_hold_color = false;

        }
    }

    public function needs_to_define_holds_color()
    {
        return ($this->difficulty_system == 1 || $this->difficulty_system == 2);
    }

    public function system_can_have_levels()
    {
        return ($this->difficulty_system != 2);
    }

    public function needs_to_defined_grade()
    {
        $grade_val = GymGradeLine::where('gym_grade_id', $this->id)->sum('grade_val');
        return ($this->system_can_have_levels() && $grade_val != 0);
    }
}