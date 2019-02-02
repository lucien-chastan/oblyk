<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Cross extends Model
{

    protected $dates = [
        'release_at'
    ];

    public function route()
    {
        return $this->hasOne('App\Route', 'id', 'route_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function crossSections()
    {
        return $this->hasMany('App\CrossSection', 'cross_id', 'id');
    }

    public function crossUsers()
    {
        return $this->hasMany('App\CrossUser', 'cross_id', 'id');
    }

    public function description()
    {
        return $this->hasOne('App\Description', 'cross_id', 'id');
    }

    public function crossStatus()
    {
        return $this->hasOne('App\CrossStatus', 'id', 'status_id');
    }

    public function crossMode()
    {
        return $this->hasOne('App\CrossMode', 'id', 'mode_id');
    }

    public function crossHardness()
    {
        return $this->hasOne('App\CrossHardness', 'id', 'hardness_id');
    }

    /**
     * return min val grade from route section
     * @return int
     */
    public function minGrade()
    {
        $CrossSection = CrossSection::class;
        $RouteSection = RouteSection::class;
        $minGrade = 100;

        $crossSections = $CrossSection::where('cross_id', $this->id)->get();
        foreach ($crossSections as $crossSection) {
            $routeSection = $RouteSection::find($crossSection->route_section_id);
            if ($minGrade > $routeSection->grade_val) {
                $minGrade = $routeSection->grade_val;
            }
        }
        return $minGrade;
    }

    /**
     * return max val grade from route section
     * @return int
     */
    public function maxGrade()
    {
        $CrossSection = CrossSection::class;
        $RouteSection = RouteSection::class;
        $maxGrade = 0;

        $crossSections = $CrossSection::where('cross_id', $this->id)->get();
        foreach ($crossSections as $crossSection) {
            $routeSection = $RouteSection::find($crossSection->route_section_id);
            if ($maxGrade < $routeSection->grade_val) {
                $maxGrade = $routeSection->grade_val;
            }
        }
        return $maxGrade;
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

        //Filtre sur le type de grimpe
        $climbs_id = [];
        $filter_climbs = json_decode($user->settings->filter_climb);
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
            $firstCross = Cross::where('user_id', $user->id)->orderBy('release_at')->first();
            $start = $firstCross->release_at;
            $end = Carbon::now();
        }

        $crosses = Cross::where('user_id', $user->id)
            ->whereBetween('release_at', [$start, $end])
            ->whereIn('status_id', $statuses_id)
            ->whereHas('route', function ($query) use ($climbs_id) {
                $query->whereIn('climb_id', $climbs_id);
            })
            ->with('route')
            ->with('route.crag')
            ->with('route.crag.gapGrade')
            ->with('crossSections')
            ->with('crossSections.routeSection')
            ->orderBy('release_at')
            ->get();

        return $crosses;

    }
}