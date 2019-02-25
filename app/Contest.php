<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    protected $dates = [
        'start_at',
        'end_at'
    ];

    public function gym()
    {
        return $this->hasOne('App\Gym', 'id', 'gym_id');
    }

    public function contestUsers()
    {
        return $this->hasMany('App\ContestUser', 'contest_id', 'id');
    }

    public function contestRoutes()
    {
        return $this->hasMany('App\ContestRoute', 'contest_id', 'id');
    }

    /**
     * Returns a default name if it is empty
     * @return string
     */
    public function name(): string
    {
        if ($this->label != '') {
            return $this->label;
        } else {
            return 'Contest ' . $this->period();
        }
    }

    /**
     * @return bool
     */
    public function hasCover(): bool
    {
        return file_exists(storage_path('app/public/contests/1300/contest-' . $this->id . '.jpg'));
    }

    /**
     * @param int $size in [50, 100, 200, 1300]
     * @return string
     */
    public function cover(int $size = 1300): string
    {
        if ($this->hasCover()) {
            return '/storage/contests/' . $size . '/contest-' . $this->id . '.jpg';
        } else {
            $gym = Gym::find($this->id);
            return $gym->bandeau(1300);
        }
    }

    public function isRealTimeResult(): bool
    {
        return $this->real_time_result ?? true;
    }

    public function subscribersNeedToBeValidated(): bool
    {
        return $this->subscribers_need_validation ?? false;
    }

    public function areRouteHiddenBeforeTheContest(): bool
    {
        return $this->hide_route_before_contest ?? true;
    }

    public function participantsAreLimited(): bool
    {
        return ($this->participant_limit > 0 && $this->participant_limit != null);
    }

    public function hasValidationMessage(): bool
    {
        return ($this->subscribersNeedToBeValidated() && $this->validation_message != '' && $this->validation_message != null);
    }

    /**
     * returns number of participants
     * @param bool $validatedUser count or not unvalidated subscribers
     * @return int
     */
    public function numberOfParticipants($validatedUser = false): int
    {
        if ($validatedUser && $this->subscribersNeedToBeValidated()) {
            return ContestUser::where([['contest_id', $this->id], ['validated', true]])->count();
        } else {
            return ContestUser::where('contest_id', $this->id)->count();
        }
    }

    /**
     * returns number of remaining places in this contest
     * @param bool $validatedUser count or not unvalidated subscribers
     * @return int
     */
    public function remainingPlaces($validatedUser = false): int
    {
        return $this->participant_limit - $this->numberOfParticipants($validatedUser);
    }

    /**
     * returns if contest is full
     * @param bool $validatedUser count or not unvalidated subscribers
     * @return bool
     */
    public function isFull($validatedUser = false): bool
    {
        return ($this->remainingPlaces($validatedUser) <= 0);
    }

    /**
     * returns number of routes in this contest
     * @return int
     */
    public function numberOfRoutes(): int
    {
        return ContestRoute::where('contest_id', $this->id)->count();
    }

    /**
     * returns if contest has presentation video
     * @return bool
     */
    public function hasPresentationVideo(): bool
    {
        $video = Video::where([['viewable_id', $this->id], ['viewable_type', 'App\Contest']])->count();
        return ($video > 0);
    }

    public function presentationVideo()
    {
        return Video::where([['viewable_id', $this->id], ['viewable_type', 'App\Contest']])->first();
    }

    public function period(): string
    {
        if ($this->start_at->format('Y-m-d') == $this->end_at->format('Y-m-d')) {
            return trans('pages/contests/global.short_period', [
                'date' => $this->start_at->format('d/m/Y'),
                'start_time' => $this->start_at->format('H\hi'),
                'end_time' => $this->end_at->format('H\hi')
            ]);
        } else {
            return trans('pages/contests/global.long_period', [
                'start_date' => $this->start_at->format('d/m/Y'),
                'start_time' => $this->start_at->format('H\hi'),
                'end_date' => $this->end_at->format('d/m/Y'),
                'end_time' => $this->end_at->format('H\hi')
            ]);
        }
    }

    /**
     * returns the end of contest with additional time
     * @return Carbon
     */
    public function endWithAdditionalTime(): Carbon
    {
        if ($this->haveAdditionalTime()) {
            return $this->end_at->addMinutes($this->minutes_after_end);
        } else {
            return $this->end_at;
        }
    }

    /**
     * returns if contest is over
     * @return bool
     */
    public function isOutOfDate(): bool
    {
        return Carbon::now() > $this->end_at;
    }

    /**
     * returns if contest is over and additional time si out of date
     * @return bool
     */
    public function isOutOfDateWithAdditionalTime(): bool
    {
        return Carbon::now() > $this->endWithAdditionalTime();
    }

    /**
     * returns if the contest is coming soon
     * @return bool
     */
    public function comingSoon(): bool
    {
        return Carbon::now() < $this->start_at;
    }

    /**
     * returns if the contest is now running
     * @return bool
     */
    public function isNow(): bool
    {
        return (!$this->isOutOfDate() && !$this->comingSoon());
    }

    /**
     * returns if we are in additional time
     * @return bool
     */
    public function inAdditionalTime(): bool
    {
        return (Carbon::now() < $this->endWithAdditionalTime() && $this->isOutOfDate());
    }

    /**
     * returns if we have additional time
     * @return bool
     */
    public function haveAdditionalTime(): bool
    {
        return ($this->minutes_after_end > 0);
    }

    /**
     * returns the number of minutes before the start of the contest
     * @return int
     */
    public function minutesBeforeStart(): int
    {
        if ($this->comingSoon()) {
            return Carbon::now()->diffInMinutes($this->start_at);
        } else {
            return 0;
        }
    }

    /**
     * returns the number of minutes before the end of the contest
     * @return int
     */
    public function minutesBeforeEnd(): int
    {
        if (!$this->isOutOfDate()) {
            return $this->end_at->diffInMinutes(Carbon::now());
        } else {
            return 0;
        }
    }

    /**
     * returns the number of minutes before the end of the contest with additional time
     * @return int
     */
    public function minutesBeforeEndWithAdditionalTime(): int
    {
        if (!$this->isOutOfDateWithAdditionalTime()) {
            return $this->endWithAdditionalTime()->diffInMinutes(Carbon::now());
        } else {
            return 0;
        }
    }

    /**
     * returns time before start for humane
     * @return string
     */
    public function startsInHowLong(): string
    {
        $minutesBeforeStart = $this->minutesBeforeStart();
        if ($minutesBeforeStart > 1440) {
            return trans_choice('pages/contests/global.in_day', round($minutesBeforeStart / 1440, 0));
        } elseif ($minutesBeforeStart > 60) {
            return trans_choice('pages/contests/global.in_hour', round($minutesBeforeStart / 60, 0));
        } else {
            return trans_choice('pages/contests/global.in_minute', $minutesBeforeStart);
        }
    }

    /**
     * returns time before end for humane
     * @return string
     */
    public function endsInHowLong(): string
    {
        $minutesAfterEnd = $this->minutesBeforeEnd();
        if ($minutesAfterEnd > 1440) {
            return trans_choice('pages/contests/global.in_day', round($minutesAfterEnd / 1440, 0));
        } elseif ($minutesAfterEnd > 60) {
            return trans_choice('pages/contests/global.in_hour', round($minutesAfterEnd / 60, 0));
        } else {
            return trans_choice('pages/contests/global.in_minute', $minutesAfterEnd);
        }
    }

    /**
     * returns time before end with additional time for humane
     * @return string
     */
    public function endsWithAdditionalTimeInHowLong(): string
    {
        $minutesAfterEnd = $this->minutesBeforeEndWithAdditionalTime();
        if ($minutesAfterEnd > 1440) {
            return trans_choice('pages/contests/global.in_day', round($minutesAfterEnd / 1440, 0));
        } elseif ($minutesAfterEnd > 60) {
            return trans_choice('pages/contests/global.in_hour', round($minutesAfterEnd / 60, 0));
        } else {
            return trans_choice('pages/contests/global.in_minute', $minutesAfterEnd);
        }
    }

    /**
     * @param bool $absolute
     * @return string
     */
    public function url($absolute = true)
    {
        return $this->webUrl($this->id, $this->name(), $absolute);
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
            'contestPage',
            [
                'contest_id' => $id,
                'contest_label' => (str_slug($label) != '') ? str_slug($label) : 'falaise'
            ],
            $absolute
        );
    }
}
