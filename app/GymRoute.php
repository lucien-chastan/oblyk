<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymRoute extends Model
{
    public $colors = [];

    public $fillable = ['label'];

    protected $dates = ['opener_date', 'dismounted_at'];

    public function sector()
    {
        return $this->hasOne('App\GymSector', 'id', 'sector_id');
    }

    public function crosses()
    {
        return $this->hasMany('App\IndoorCross', 'route_id', 'id');
    }

    public function descriptions()
    {
        return $this->morphMany('App\Description', 'descriptive');
    }

    /**
     * @return array
     */
    public function hold_colors()
    {
        $this->hold_colors = explode(';', $this->color_hold);
        return $this->hold_colors;
    }

    /**
     * @return array
     */
    public function tag_colors()
    {
        $this->tag_colors = explode(';', $this->color_tag);
        return $this->tag_colors;
    }

    public function hasPicture()
    {
        return file_exists(storage_path('app/public/gyms/routes/1300/route-' . $this->id . '.jpg'));
    }

    public function hasDescription()
    {
        return ($this->description != '');
    }


    public function picture($size = 200)
    {
        return $this->hasPicture() ? '/storage/gyms/routes/' . $size . '/route-' . $this->id . '.jpg' : '';
    }

    public function hasThumbnail()
    {
        return file_exists(storage_path('app/public/gyms/routes/100/thumbnail-' . $this->id . '.jpg'));
    }

    public function thumbnail()
    {
        return $this->hasThumbnail() ? '/storage/gyms/routes/100/thumbnail-' . $this->id . '.jpg' : '';
    }

    public function isFavorite()
    {
        return $this->favorite;
    }

    public function isDismounted()
    {
        return ($this->dismounted_at != null);
    }

    public function hasVideos()
    {
        $Video = Video::class;
        return ($Video::where([['viewable_id', $this->id], ['viewable_type', 'App\\GymRoute']])->count() > 0);
    }

    public function grades($format = 'array', $class = '')
    {
        $firstGrades = explode(';', $this->grade);
        $subGrades = explode(';', $this->sub_grade);
        $valGrades = explode(';', $this->val_grade);
        $grades = [];

        for ($i = 0; $i < count($firstGrades); $i++) {
            if ($format === 'html') {
                $grades[] = '<span class="color-grade-' . $valGrades[$i] . ' ' . $class . '">' . $firstGrades[$i] . $subGrades[$i] . '</span>';
            } else {
                $grades[] = $firstGrades[$i] . $subGrades[$i];
            }
        }

        if ($format === 'text') {
            return implode(';', $grades);
        } elseif ($format === 'html') {
            return implode(' · ', $grades);
        } else {
            return $grades;
        }
    }

    public function name()
    {
        return ($this->label != '') ? $this->label : 'Sans nom';
    }

    public function isMultiPitch()
    {
        return (count(explode(';', $this->grade)) > 1);
    }

    public function pitches()
    {
        if ($this->isMultiPitch()) {
            $pitches = [];
            $grades = explode(';', $this->grade);
            $subGrades = explode(';', $this->sub_grade);
            $valGrades = explode(';', $this->val_grade);
            $heights = explode(';', $this->height);
            for ($i = 0; $i < count($grades); $i++) {
                $pitches[] = [
                    'grade' => $grades[$i] . $subGrades[$i],
                    'first_grade' => $grades[$i],
                    'sub_grade' => $subGrades[$i],
                    'val_grade' => $valGrades[$i],
                    'height' => $heights[$i]
                ];
            }
            return $pitches;
        } else {
            return [];
        }
    }

    public function heights()
    {
        return explode(';', $this->height);
    }

    public function formatted_type($class = '')
    {
        $type = trans('elements/climb-gyms.climb_' . $this->type);
        return "<span class='type-gym-$this->type $class'>$type</span>";
    }

    public function number_of_ascents()
    {
        $Crosses = IndoorCross::class;
        return $Crosses::where([['route_id', $this->id], ['status_id', '!=', 6], ['status_id', '!=', 1]])->count();
    }

    public function estimateGradeLevel($gymGradeId)
    {
        $GymGradeLine = GymGradeLine::class;
        $gymGradeLines = $GymGradeLine::where('gym_grade_id', $gymGradeId)->orderBy('order')->get();
        $minScore = 100;
        $gradeLineId = 0;

        foreach ($gymGradeLines as $gymGradeLine) {
            $valGradDiff = abs($gymGradeLine->grade_val - explode(';', $this->val_grade)[0]);
            if ($valGradDiff < $minScore) {
                $minScore = $valGradDiff;
                $gradeLineId = $gymGradeLine->id;
            }
        }

        return $gradeLineId;
    }

    public function display_hold_color(): bool
    {
        return ($this->color_hold != '');
    }

    public function display_tag_color(): bool
    {
        return ($this->color_tag != '' && ($this->color_hold != $this->color_tag));
    }

    public function hold_color_style()
    {
        if(count($this->hold_colors()) > 1) {
            $forGradientColor = [];
            foreach ($this->hold_colors() as $color) {
                for ($i = 0; $i <= 3; $i++) {
                    $forGradientColor[] = $color;
                }
            }
            return 'background-image: linear-gradient(to right, ' . implode(',', $forGradientColor) . '); color:transparent; background-clip: text;';
        } else {
            return 'color: ' . $this->hold_colors()[0];
        }
    }

    public function tag_color_style()
    {
        if(count($this->tag_colors()) > 1) {
            $forGradientColor = [];
            foreach ($this->tag_colors() as $color) {
                for ($i = 0; $i <= 2; $i++) {
                    $forGradientColor[] = $color;
                }
            }
            return 'background-image: linear-gradient(to right, ' . implode(',', $forGradientColor) . '); color:transparent; background-clip: text;';
        } else {
            return 'color: ' . $this->tag_colors()[0];
        }
    }

    /**
     * @param bool $absolute
     * @return string
     */
    public function url($absolute = true)
    {
        $sector = GymSector::find($this->sector_id);
        $room = GymRoom::find($sector->room_id);
        return $this->webUrl($this->id, $room->gym_id, $absolute);
    }

    /**
     * @param $id
     * @param $gym_id
     * @param bool $absolute
     * @return string
     */
    static function webUrl($id, $gym_id, $absolute = true)
    {
        return route(
            'gymRoutePage',
            [
                'gym_id' => $gym_id,
                'route_id' => $id,
            ],
            $absolute
        );
    }
}
