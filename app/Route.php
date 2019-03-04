<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    public $fillable = ['label'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function crag()
    {
        return $this->hasOne('App\Crag', 'id', 'crag_id');
    }

    public function sector()
    {
        return $this->hasOne('App\Sector', 'id', 'sector_id');
    }

    public function routeSections()
    {
        return $this->hasMany('App\RouteSection', 'route_id', 'id');
    }

    public function tickLists()
    {
        return $this->hasMany('App\TickList', 'route_id', 'id');
    }

    public function crosses()
    {
        return $this->hasMany('App\Cross', 'route_id', 'id');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag', 'route_id', 'id');
    }

    public function climb()
    {
        return $this->hasOne('App\Climb', 'id', 'climb_id');
    }

    public function descriptions()
    {
        return $this->morphMany('App\Description', 'descriptive');
    }

    public function photos()
    {
        return $this->morphMany('App\Photo', 'illustrable');
    }

    public function videos()
    {
        return $this->morphMany('App\Video', 'viewable');
    }

    public function follows()
    {
        return $this->morphMany('App\Follow', 'followed');
    }

    public function versions()
    {
        return $this->morphMany('App\Version', 'versionnable');
    }

    /**
     * @param bool $absolute
     * @return string
     */
    public function url($absolute = true)
    {
        return $this->webUrl($this->id, $this->label, $absolute);
    }

    /**
     * @param $id
     * @param $label
     * @param bool $absolute
     * @return string
     */
    static function webUrl($id, $label, $absolute = true)
    {
        return route(
            'routePage',
            [
                'route_id' => $id,
                'route_label' => (str_slug($label) != '') ? str_slug($label) : 'ligne'
            ],
            $absolute
        );
    }

    /**
     * @param int $size in [50, 100, 200, 1300]
     * @return string
     */
    public function cover(int $size = 50): string
    {
        $Crag = Crag::class;

        $crag = $Crag::find($this->crag_id);
        return $crag->cover($size);
    }


    /**
     * return min val grade from route section
     * @return int
     */
    public function minGrade()
    {
        $RouteSection = RouteSection::class;
        $minGrade = $RouteSection::where('route_id', $this->id)->min('grade_val');
        return $minGrade;
    }

    /**
     * return max val grade from route section
     * @return int
     */
    public function maxGrade()
    {
        $RouteSection = RouteSection::class;
        $maxSection = $RouteSection::where('route_id', $this->id)->max('grade_val');
        return $maxSection;
    }

    public static function similarRoute($crag_id, $route_id, $label)
    {
        $Route = Route::class;

        $routes = $Route::where([
            ['crag_id', '=', $crag_id],
            ['id', '!=', $route_id],
            ['label', 'like', '%' . $label . '%']
        ])->get();

        $similar_label = '';

        foreach ($routes as $route) {
            similar_text(strtolower($label), strtolower($route->label), $similar);
            if ($similar > 90) {
                $similar_label = $route->label;
                break;
            }
        }

        return $similar_label;
    }

    //convertie une cotation en valeur
    public static function gradeToVal($grade, $sub_grade)
    {
        $val = 0;

        // Translate sub grade
        if ($sub_grade == '/+') $sub_grade = '+';
        if ($sub_grade == '/-') $sub_grade = '-';
        if ($sub_grade == '+/b') $sub_grade = '+';
        if ($sub_grade == '+/c') $sub_grade = '+';
        if ($sub_grade == '?') $sub_grade = '';
        if ($sub_grade == '+/?') $sub_grade = '+';
        if ($sub_grade == '-/?') $sub_grade = '-';

        // Concat grade and sub grade
        $gradeSub = $grade . $sub_grade;

        // Annot grade type
        if ($grade == 'B0') $val = 13;
        if ($grade == 'B1') $val = 15;
        if ($grade == 'B2') $val = 17;
        if ($grade == 'B3') $val = 23;
        if ($grade == 'B4') $val = 32;
        if ($grade == 'B5') $val = 34;
        if ($grade == 'B6') $val = 36;
        if ($grade == 'B7') $val = 37;
        if ($grade == 'B8') $val = 38;
        if ($grade == 'B9') $val = 39;
        if ($grade == 'B10') $val = 40;
        if ($grade == 'B11') $val = 41;
        if ($grade == 'B12') $val = 42;
        if ($grade == 'B13') $val = 43;
        if ($grade == 'B14') $val = 44;
        if ($grade == 'B15') $val = 45;
        if ($grade == 'B16') $val = 46;
        if ($grade == 'B17') $val = 47;
        if ($grade == 'B18') $val = 48;
        if ($grade == 'B19') $val = 49;
        if ($grade == 'B20') $val = 50;

        // Hueco grade type
        if ($grade == 'VB') $val = 13;
        if ($gradeSub == 'V0-') $val = 14;
        if ($gradeSub == 'V0') $val = 15;
        if ($gradeSub == 'V0+') $val = 17;
        if ($grade == 'V1') $val = 21;
        if ($grade == 'V2') $val = 23;
        if ($grade == 'V3') $val = 27;
        if ($grade == 'V4') $val = 34;
        if ($grade == 'V5') $val = 36;
        if ($grade == 'V6') $val = 37;
        if ($grade == 'V7') $val = 38;
        if ($grade == 'V8') $val = 40;
        if ($grade == 'V9') $val = 41;
        if ($grade == 'V10') $val = 42;
        if ($grade == 'V11') $val = 43;
        if ($grade == 'V12') $val = 44;
        if ($grade == 'V13') $val = 45;
        if ($grade == 'V14') $val = 46;
        if ($grade == 'V15') $val = 47;
        if ($grade == 'V16') $val = 48;

        // "1a, 2c" grade type
        if ($gradeSub == '1-') $val = 1;
        if ($gradeSub == '1') $val = 3;
        if ($gradeSub == '1+') $val = 5;
        if ($grade == '1a') $val = 1;
        if ($grade == '1a+') $val = 2;
        if ($grade == '1b') $val = 3;
        if ($grade == '1b+') $val = 4;
        if ($grade == '1c') $val = 5;
        if ($grade == '1c+') $val = 6;
        if ($gradeSub == '2-') $val = 7;
        if ($gradeSub == '2') $val = 9;
        if ($gradeSub == '2+') $val = 11;
        if ($grade == '2a') $val = 7;
        if ($grade == '2a+') $val = 8;
        if ($grade == '2b') $val = 9;
        if ($grade == '2b+') $val = 10;
        if ($grade == '2c') $val = 11;
        if ($grade == '2c+') $val = 12;
        if ($gradeSub == '3-') $val = 13;
        if ($gradeSub == '3') $val = 15;
        if ($gradeSub == '3+') $val = 17;
        if ($grade == '3a') $val = 13;
        if ($grade == '3a+') $val = 14;
        if ($grade == '3b') $val = 15;
        if ($grade == '3b+') $val = 16;
        if ($grade == '3c') $val = 17;
        if ($grade == '3c+') $val = 18;
        if ($gradeSub == '4-') $val = 19;
        if ($gradeSub == '4') $val = 21;
        if ($gradeSub == '4+') $val = 23;
        if ($grade == '4a') $val = 19;
        if ($grade == '4a+') $val = 20;
        if ($grade == '4b') $val = 21;
        if ($grade == '4b+') $val = 22;
        if ($grade == '4c') $val = 23;
        if ($grade == '4c+') $val = 24;
        if ($gradeSub == '5-') $val = 25;
        if ($gradeSub == '5') $val = 27;
        if ($gradeSub == '5+') $val = 29;
        if ($grade == '5a') $val = 25;
        if ($grade == '5a+') $val = 26;
        if ($grade == '5b') $val = 27;
        if ($grade == '5b+') $val = 28;
        if ($grade == '5c') $val = 29;
        if ($grade == '5c+') $val = 30;
        if ($gradeSub == '6-') $val = 31;
        if ($gradeSub == '6') $val = 33;
        if ($gradeSub == '6+') $val = 36;
        if ($grade == '6a') $val = 31;
        if ($grade == '6a+') $val = 32;
        if ($grade == '6b') $val = 33;
        if ($grade == '6b+') $val = 34;
        if ($grade == '6c') $val = 35;
        if ($grade == '6c+') $val = 36;
        if ($gradeSub == '7-') $val = 37;
        if ($gradeSub == '7') $val = 39;
        if ($gradeSub == '7+') $val = 41;
        if ($grade == '7a') $val = 37;
        if ($grade == '7a+') $val = 38;
        if ($grade == '7b') $val = 39;
        if ($grade == '7b+') $val = 40;
        if ($grade == '7c') $val = 41;
        if ($grade == '7c+') $val = 42;
        if ($gradeSub == '8-') $val = 43;
        if ($gradeSub == '8') $val = 45;
        if ($gradeSub == '8+') $val = 47;
        if ($grade == '8a') $val = 43;
        if ($grade == '8a+') $val = 44;
        if ($grade == '8b') $val = 45;
        if ($grade == '8b+') $val = 46;
        if ($grade == '8c') $val = 47;
        if ($grade == '8c+') $val = 48;
        if ($gradeSub == '9-') $val = 49;
        if ($gradeSub == '9') $val = 51;
        if ($gradeSub == '9+') $val = 53;
        if ($grade == '9a') $val = 49;
        if ($grade == '9a+') $val = 50;
        if ($grade == '9b') $val = 51;
        if ($grade == '9b+') $val = 52;
        if ($grade == '9c') $val = 53;
        if ($grade == '9c+') $val = 54;

        // Middle grade
        if ($grade == '2/3') $val = 9;
        if ($grade == '3/4') $val = 15;
        if ($grade == '4/5') $val = 21;
        if ($grade == '5/6') $val = 27;
        if ($grade == '6/7') $val = 33;
        if ($grade == '7/8') $val = 39;
        if ($grade == '8/9') $val = 45;
        if ($grade == '2c+/3a') $val = 11;
        if ($grade == '3c+/4a') $val = 17;
        if ($grade == '4c+/5a') $val = 23;
        if ($grade == '5c+/6a') $val = 29;
        if ($grade == '6c+/7a') $val = 35;
        if ($grade == '7c+/8a') $val = 41;
        if ($grade == '8c+/9a') $val = 47;

        // 5.10 grade type
        if ($grade == '5.1') $val = 1;
        if ($grade == '5.2') $val = 7;
        if ($grade == '5.3') $val = 9;
        if ($grade == '5.4') $val = 13;
        if ($grade == '5.5') $val = 15;
        if ($grade == '5.6') $val = 19;
        if ($grade == '5.7') $val = 21;
        if ($grade == '5.8') $val = 25;
        if ($grade == '5.9') $val = 27;
        if ($grade == '5.10a') $val = 29;
        if ($grade == '5.10b') $val = 31;
        if ($grade == '5.10c') $val = 32;
        if ($grade == '5.10d') $val = 33;
        if ($grade == '5.11a') $val = 34;
        if ($grade == '5.11b') $val = 35;
        if ($grade == '5.11c') $val = 36;
        if ($grade == '5.11d') $val = 37;
        if ($grade == '5.12a') $val = 38;
        if ($grade == '5.12b') $val = 39;
        if ($grade == '5.12c') $val = 40;
        if ($grade == '5.12d') $val = 41;
        if ($grade == '5.13a') $val = 42;
        if ($grade == '5.13b') $val = 43;
        if ($grade == '5.13c') $val = 44;
        if ($grade == '5.13d') $val = 45;
        if ($grade == '5.14a') $val = 46;
        if ($grade == '5.14b') $val = 47;
        if ($grade == '5.14c') $val = 48;
        if ($grade == '5.14d') $val = 49;
        if ($grade == '5.15a') $val = 50;
        if ($grade == '5.15b') $val = 51;
        if ($grade == '5.15c') $val = 52;
        if ($grade == '5.15d') $val = 53;

        // German grade type
        if ($gradeSub == 'III-') $val = 7;
        if ($gradeSub == 'III') $val = 9;
        if ($gradeSub == 'III+') $val = 13;
        if ($gradeSub == 'IV-') $val = 15;
        if ($gradeSub == 'IV') $val = 19;
        if ($gradeSub == 'IV+') $val = 21;
        if ($gradeSub == 'V-') $val = 23;
        if ($gradeSub == 'V') $val = 24;
        if ($gradeSub == 'V+') $val = 25;
        if ($gradeSub == 'VI-') $val = 27;
        if ($gradeSub == 'VI') $val = 29;
        if ($gradeSub == 'VI+') $val = 31;
        if ($gradeSub == 'VII-') $val = 32;
        if ($gradeSub == 'VII') $val = 33;
        if ($gradeSub == 'VII+') $val = 34;
        if ($gradeSub == 'VIII-') $val = 35;
        if ($gradeSub == 'VIII') $val = 36;
        if ($gradeSub == 'VIII+') $val = 37;
        if ($gradeSub == 'IX-') $val = 38;
        if ($gradeSub == 'IX') $val = 40;
        if ($gradeSub == 'IX+') $val = 41;
        if ($gradeSub == 'X-') $val = 44;
        if ($gradeSub == 'X') $val = 45;
        if ($gradeSub == 'X+') $val = 46;
        if ($gradeSub == 'XI-') $val = 48;
        if ($gradeSub == 'XI') $val = 49;
        if ($gradeSub == 'XI+') $val = 50;
        if ($gradeSub == 'XII-') $val = 51;
        if ($gradeSub == 'XII') $val = 52;
        if ($gradeSub == 'XII+') $val = 53;

        // England grade type
        if ($grade == 'M') $val = 1;
        if ($grade == 'D') $val = 9;
        if ($grade == 'VD') $val = 19;
        if ($grade == 'S') $val = 21;
        if ($grade == 'HS') $val = 23;
        if ($grade == 'VS') $val = 25;
        if ($grade == 'HVS') $val = 27;
        if ($grade == 'E1') $val = 31;
        if ($grade == 'E2') $val = 33;
        if ($grade == 'E3') $val = 35;
        if ($grade == 'E4') $val = 37;
        if ($grade == 'E5') $val = 38;
        if ($grade == 'E6') $val = 40;
        if ($grade == 'E7') $val = 42;
        if ($grade == 'E8') $val = 44;
        if ($grade == 'E9') $val = 45;
        if ($grade == 'E10') $val = 46;
        if ($grade == 'E11') $val = 48;


        // Multi pitch grade type
        if ($grade == 'PD') $val = 13;
        if ($gradeSub == 'AD-') $val = 19;
        if ($gradeSub == 'AD') $val = 21;
        if ($gradeSub == 'AD+') $val = 23;
        if ($gradeSub == 'D-') $val = 25;
        if ($gradeSub == 'D') $val = 27;
        if ($gradeSub == 'D+') $val = 29;
        if ($gradeSub == 'TD-') $val = 31;
        if ($gradeSub == 'TD') $val = 33;
        if ($gradeSub == 'TD+') $val = 35;
        if ($gradeSub == 'ED-') $val = 37;
        if ($gradeSub == 'ED') $val = 39;
        if ($gradeSub == 'ED+') $val = 41;
        if ($gradeSub == 'ABO-') $val = 43;
        if ($gradeSub == 'ABO') $val = 45;
        if ($gradeSub == 'ABO+') $val = 47;

        // Trad grade type
        if ($grade == 'A0') $val = 16;
        if ($grade == 'A1') $val = 22;
        if ($grade == 'A2') $val = 28;
        if ($grade == 'A3') $val = 33;
        if ($grade == 'A4') $val = 40;
        if ($grade == 'A5') $val = 46;
        if ($grade == 'A6') $val = 52;

        return $val;
    }

    // Convert value grade to french type grade
    public static function valToGrad($val, $withBalancing = false)
    {
        if ($val == 0) $val = 0;
        if (!$withBalancing && $val % 2 == 0) $val--;

        $grades = [
            '?',
            '1a', '1a+', '1b', '1b+', '1c', '1c+',
            '2a', '2a+', '2b', '2b+', '2c', '2c+',
            '3a', '3a+', '3b', '3b+', '3c', '3c+',
            '4a', '4a+', '4b', '4b+', '4c', '4c+',
            '5a', '5a+', '5b', '5b+', '5c', '5c+',
            '6a', '6a+', '6b', '6b+', '6c', '6c+',
            '7a', '7a+', '7b', '7b+', '7c', '7c+',
            '8a', '8a+', '8b', '8b+', '8c', '8c+',
            '9a', '9a+', '9b', '9b+', '9c', '9c+',
        ];

        return $grades[$val];
    }
}
