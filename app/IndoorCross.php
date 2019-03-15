<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class IndoorCross extends Model
{

    protected $dates = [
        'release_at'
    ];

    public function gym(){
        return $this->hasOne('App\Gym','id', 'gym_id');
    }

    public function room(){
        return $this->hasOne('App\GymRoom','id', 'room_id');
    }

    public function sector(){
        return $this->hasOne('App\GymSector','id', 'sector_id');
    }

    public function route(){
        return $this->hasOne('App\GymRoute','id', 'route_id');
    }

    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function crossStatus(){
        return $this->hasOne('App\CrossStatus','id', 'status_id');
    }

    public function crossMode(){
        return $this->hasOne('App\CrossMode','id', 'mode_id');
    }

    /**
     * @return array
     */
    public function colors()
    {
        $this->colors = explode(';', $this->color);
        return $this->colors;
    }

    public function hasRoom()
    {
        return ($this->room_id);
    }

    public function hasSector()
    {
        return ($this->sector_id);
    }

    public function hasRoute()
    {
        return ($this->route_id);
    }

    public function hasGym()
    {
        return ($this->gym_id);
    }

    public function color_style()
    {
        if(count($this->colors()) > 1) {
            $forGradientColor = [];
            foreach ($this->colors() as $color) {
                for ($i = 0; $i <= 3; $i++) {
                    $forGradientColor[] = $color;
                }
            }
            return 'background-image: linear-gradient(to right, ' . implode(',', $forGradientColor) . '); color:transparent; background-clip: text;';
        } else {
            return 'color: ' . $this->colors()[0];
        }
    }

    public static function getCrossWithFilter($user)
    {
        // Filter by status
        $statuses_id = [];
        $filter_statuses = json_decode($user->settings->filter_status);
        foreach ($filter_statuses as $key => $filter_status) {
            if ($filter_status == true) {
                $statuses_id[] = $key;
            }
        }

        // Filter by climbing type
        $climbs_id = [];
        $filter_climbs = json_decode($user->settings->filter_indoor_climb);
        foreach ($filter_climbs as $key => $filter_climb) {
            if ($filter_climb == true) {
                $climbs_id[] = $key;
            }
        }

        // Filter by period
        $periods = json_decode($user->settings->filter_period);
        $filter_periods = [];
        foreach ($periods as $key => $period) $filter_periods[$key] = $period;

        if ($filter_periods['start'] != 'first' && $filter_periods['end'] != 'now') {
            // custom
            $start = $filter_periods['start'];
            $end = $filter_periods['end'];
        } else {
            $firstCross = IndoorCross::where('user_id', $user->id)->orderBy('release_at')->first();
            $start =  ($firstCross) ? $firstCross->release_at : Carbon::now();
            $end = Carbon::now();
        }

        $crosses = IndoorCross::where('user_id', $user->id)
            ->whereBetween('release_at', [$start, $end])
            ->whereIn('status_id', $statuses_id)
            ->whereIn('type', $climbs_id)
            ->with('gym')
            ->orderBy('release_at')
            ->get();

        return $crosses;
    }
}