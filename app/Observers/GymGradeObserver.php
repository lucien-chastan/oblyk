<?php

namespace App\Observers;

use App\GymGrade;
use App\GymGradeLine;

class GymGradeObserver
{

    /**
     * @param GymGrade $grade
     */
    public function creating(GymGrade $grade) {
        $grade->label = strip_tags($grade->label);
    }

    /**
     * Listen to the GymGrade updating event.
     *
     * @param GymGrade $grade
     * @return void
     */
    public function updating(GymGrade $grade)
    {
        $grade->label = strip_tags($grade->label);
    }

    /**
     * Listen to the GymGrade deleting event.
     *
     * @param GymGrade $grade
     * @return void
     */
    public function deleting(GymGrade $grade) {
        $GymGradeLine = GymGradeLine::class;
        try {
            $gradeLines = $GymGradeLine::where('gym_grade_id', $grade->id)->get();
            foreach ($gradeLines as $gradeLine) {
                $gradeLine->delete();
            }
        } catch (\Exception $e) {}
    }
}