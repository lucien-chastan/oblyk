<?php

namespace App\Http\Middleware;

use App\GymAdministrator;
use Closure;

class CheckGymAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $gym_id
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $gym_id = $request->route('gym_id');
        $isAdministrator = GymAdministrator::where([['user_id', $request->user()->id], ['gym_id',$gym_id]])->exists();

        if (!$isAdministrator) {
            return redirect('/');
        }

        return $next($request);
    }
}
