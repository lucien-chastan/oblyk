<?php

namespace App;

use App\Route;

use Illuminate\Database\Eloquent\Model;
use Cache;

class GapGrade extends Model
{
    public function spreadable(){
        return $this->morphTo();
    }

    private function get_corrected_min_grade($v) {
        $minGrade = 10000;
        $this->spreadable->routes->each(function($e) use (&$minGrade, $v) { 
            foreach($e->routeSections as $r) {
                if ($r->grade_val < $minGrade && $r->grade_val != $v)
                    $minGrade = $r->grade_val;
            }
        });
        $minGrade = ($minGrade == 10000) ? $this->min_grade_val : $minGrade;
        return $minGrade;
    }
    public function getMinGradeValAttribute($v) {
        if ($v != 0)
            return $v;

        return $this->get_corrected_min_grade($v);
    }

    public function getMinGradeTextAttribute($v) {
        if ($v != "?")
            return $v;

        $minGrade = $this->get_corrected_min_grade($v);
        return Route::valToGrad($minGrade);
    }
}
