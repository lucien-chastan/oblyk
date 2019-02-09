<?php

namespace App\Http\Controllers\Chart\Crosses;

use App\Cross;
use App\Http\Controllers\Controller;
use App\IndoorCross;
use Illuminate\Http\Request;

class UserCrossesTypeClimbController extends Controller
{

    // Climbing type graph
    function climbChart(Request $request)
    {

        $crosses = Cross::where('user_id', $request->input('user_id'))->with('route')->get();
        $indoorCrosses = IndoorCross::where('user_id', $request->input('user_id'))->get();
        $climbArray = [
            1 => 0, 2 => 0, 3 => 0,
            4 => 0, 5 => 0, 6 => 0,
            7 => 0, 8 => 0, 9 => 0,
            'gym_route' => 0,
            'gym_pan' => 0,
            'gym_boulder' => 0,
        ];

        foreach ($crosses as $cross) {
            $climbArray[$cross->route->climb_id]++;
        }

        foreach ($indoorCrosses as $indoorCross) {
            if ($indoorCross->type == 0) {
                $climbArray['gym_route']++;
            } elseif ($indoorCross->type == 1) {
                $climbArray['gym_pan']++;
            } elseif ($indoorCross->type == 2) {
                $climbArray['gym_boulder']++;
            }
        }

        $data = [
            'type' => 'doughnut',
            'data' => [
                'labels' => [
                    trans('elements/climbs.climb_2'), trans('elements/climbs.climb_3'), trans('elements/climbs.climb_4'), trans('elements/climbs.climb_5'), trans('elements/climbs.climb_6'), trans('elements/climbs.climb_7'), trans('elements/climbs.climb_8'),
                    trans('elements/climbs.climb_3'), trans('elements/climbs.climb_pan'), trans('elements/climbs.climb_2'),
                ],
                'datasets' => [
                    [
                        'data' => [
                            $climbArray[2], $climbArray[3], $climbArray[4], $climbArray[5], $climbArray[6], $climbArray[7], $climbArray[8], $climbArray['gym_route'], $climbArray['gym_pan'], $climbArray['gym_boulder']
                        ],
                        'backgroundColor' => [
                            'rgb(255,204,0)', 'rgb(55,113,200)', 'rgb(255,85,85)', 'rgb(233,43,43)', 'rgb(212,0,0)', 'rgb(135,205,222)', 'rgb(55,200,113)',
                            '#672178', '#a268b0', '#ddafe9',
                        ]
                    ]
                ]
            ],
            'options' => [
                'maintainAspectRatio' => false,
                'legend' => [
                    'display' => false,
                    'position' => 'bottom'
                ]
            ]
        ];

        return response()->json(json_encode($data));
    }
}
