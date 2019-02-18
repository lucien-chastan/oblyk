<?php

namespace App\Http\Controllers\Vue;

use App\Gym;
use App\IndoorCross;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;

class GymVueController extends Controller
{
    function vueMap($id)
    {
        $Gym = Gym::class;
        $data = ['gym' => $Gym::where('id',$id)->first()];
        return view('pages.gym.vues.mapVue', $data);
    }

    function vueFilActu($id)
    {
        $Gym = Gym::class;
        $gym = $Gym::where('id', $id)->with('administrators')->first();

        $data = [
            'gym' => $gym,
            'is_administrator' => $gym->userIsAdministrator(Auth::id())
        ];
        return view('pages.gym.vues.filActuVue',$data);
    }

    function vueGymCrossList($id)
    {
        $Gym = Gym::class;
        $Cross = IndoorCross::class;

        $gym = $Gym::find($id);

        $crosses = $Cross::where([['user_id', Auth::id()], ['gym_id', $gym->id]])
            ->with('gym')
            ->with('room')
            ->with('room.gym')
            ->with('sector')
            ->with('route')
            ->orderBy('release_at', 'DESC')
            ->get();

        $data = [
            'gym' => $gym,
            'crosses' => $crosses
        ];

        return view('pages.gym.vues.crossesListVue',$data);
    }
}