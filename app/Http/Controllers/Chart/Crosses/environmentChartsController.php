<?php

namespace App\Http\Controllers\Chart\Crosses;

use App\Cross;
use App\Http\Controllers\Controller;
use App\IndoorCross;
use App\Rock;
use App\User;
use Illuminate\Support\Facades\Auth;

class environmentChartsController extends Controller
{


    // Crags and gyms graph
    function crags()
    {
        $user = User::where('id', Auth::id())->with('settings')->first();
        $crosses = Cross::getCrossWithFilter($user);
        $indoorCrosses = IndoorCross::getCrossWithFilter($user);

        $cragsData = [];
        $cragsLabel = [];

        foreach ($crosses as $cross) {
            $cragsLabel[$cross->route->crag->id] = $cross->route->crag->label;
            if (isset($cragsData[$cross->route->crag->id])) {
                $cragsData[$cross->route->crag->id]++;
            } else {
                $cragsData[$cross->route->crag->id] = 1;
            }
        }

        foreach ($indoorCrosses as $cross) {
            $cragsLabel[$cross->gym->id] = $cross->gym->label;
            if (isset($cragsData[$cross->gym->id])) {
                $cragsData[$cross->gym->id]++;
            } else {
                $cragsData[$cross->gym->id] = 1;
            }
        }

        // re-index
        $cragsLabel = array_values($cragsLabel);
        $cragsData = array_values($cragsData);

        $data = [
            'type' => 'bar',
            'data' => [
                'labels' => $cragsLabel,
                'datasets' => [
                    [
                        'label' => '',
                        'data' => $cragsData,
                        'borderColor' => '#2196F3',
                        'backgroundColor' => '#2196F3'
                    ]
                ]
            ],
            'options' => [
                'maintainAspectRatio' => false,
                'scales' => [
                    'display' => false,
                    'yAxes' => [
                        [
                            'ticks' => [
                                'suggestedMin' => 0,
                                'stepSize' => 1
                            ],
                            'display' => false
                        ]
                    ]
                ],
                'legend' => [
                    'display' => false
                ]
            ]
        ];

        return response()->json(json_encode($data));
    }


    function regions()
    {
        $user = User::where('id', Auth::id())->with('settings')->first();
        $crosses = Cross::getCrossWithFilter($user);
        $indoorCrosses = IndoorCross::getCrossWithFilter($user);

        $datas = [];
        $labels = [];

        foreach ($crosses as $cross) {
            $labels[$cross->route->crag->region] = $cross->route->crag->region;
            if (isset($datas[$cross->route->crag->region])) {
                $datas[$cross->route->crag->region]++;
            } else {
                $datas[$cross->route->crag->region] = 1;
            }
        }

        foreach ($indoorCrosses as $cross) {
            $labels[$cross->gym->region] = $cross->gym->region;
            if (isset($datas[$cross->gym->region])) {
                $datas[$cross->gym->region]++;
            } else {
                $datas[$cross->gym->region] = 1;
            }
        }

        // re-index
        $labels = array_values($labels);
        $datas = array_values($datas);

        $data = [
            'type' => 'bar',
            'data' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => '',
                        'data' => $datas,
                        'borderColor' => '#FF5722',
                        'backgroundColor' => '#FF5722'
                    ]
                ]
            ],
            'options' => [
                'maintainAspectRatio' => false,
                'scales' => [
                    'display' => false,
                    'yAxes' => [
                        [
                            'ticks' => [
                                'suggestedMin' => 0,
                                'stepSize' => 1
                            ],
                            'display' => false
                        ]
                    ]
                ],
                'legend' => [
                    'display' => false
                ]
            ]
        ];

        return response()->json(json_encode($data));
    }


    function pays()
    {
        $user = User::where('id', Auth::id())->with('settings')->first();
        $crosses = Cross::getCrossWithFilter($user);
        $indoorCrosses = IndoorCross::getCrossWithFilter($user);

        $datas = [];
        $labels = [];

        foreach ($crosses as $cross) {
            $labels[$cross->route->crag->code_country] = $cross->route->crag->code_country;
            if (isset($datas[$cross->route->crag->code_country])) {
                $datas[$cross->route->crag->code_country]++;
            } else {
                $datas[$cross->route->crag->code_country] = 1;
            }
        }

        foreach ($indoorCrosses as $cross) {
            $labels[$cross->gym->code_country] = $cross->gym->code_country;
            if (isset($datas[$cross->gym->code_country])) {
                $datas[$cross->gym->code_country]++;
            } else {
                $datas[$cross->gym->code_country] = 1;
            }
        }

        //réindex à partir de zéro
        $labels = array_values($labels);
        $datas = array_values($datas);

        $data = [
            'type' => 'bar',
            'data' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => '',
                        'data' => $datas,
                        'borderColor' => '#2196F3',
                        'backgroundColor' => '#2196F3'
                    ]
                ]
            ],
            'options' => [
                'maintainAspectRatio' => false,
                'scales' => [
                    'display' => false,
                    'yAxes' => [
                        [
                            'ticks' => [
                                'suggestedMin' => 0,
                                'stepSize' => 1
                            ],
                            'display' => false
                        ]
                    ]
                ],
                'legend' => [
                    'display' => false
                ]
            ]
        ];

        return response()->json(json_encode($data));
    }


    // Graph by rocks
    function rocks()
    {
        $user = User::where('id', Auth::id())->with('settings')->first();
        $crosses = Cross::getCrossWithFilter($user);
        $indoorCrosses = IndoorCross::getCrossWithFilter($user);

        $rocksData = [];
        $rocksLabel = [];
        $rocks = Rock::all();

        // Label list
        foreach ($rocks as $rock) {
            $rocksLabel[$rock->id - 1] = trans('elements/rocks.rock_' . $rock->id);
            $rocksData[$rock->id - 1] = 0;
        }

        // Cross by rocks
        foreach ($crosses as $cross) $rocksData[$cross->route->crag->rock_id - 1]++;

        if(count($indoorCrosses) > 0) {
            $rocksLabel[] = trans('elements/rocks.resin');
            $rocksData[] = count($indoorCrosses);
        }

        $data = [
            'type' => 'radar',
            'data' => [
                'labels' => $rocksLabel,
                'datasets' => [
                    [
                        'label' => '',
                        'data' => $rocksData,
                        'borderColor' => '#FF5722'
                    ]
                ]
            ],
            'options' => [
                'maintainAspectRatio' => false,
                'scales' => [
                    'display' => false,
                    'yAxes' => [
                        [
                            'ticks' => [
                                'suggestedMin' => 0,
                                'stepSize' => 1
                            ]
                        ]
                    ]
                ],
                'legend' => [
                    'display' => false
                ]
            ]
        ];

        return response()->json(json_encode($data));
    }


    // Map
    function maps()
    {
        $user = User::where('id', Auth::id())->with('settings')->first();
        $crosses = Cross::getCrossWithFilter($user);
        $indoorCrosses = IndoorCross::getCrossWithFilter($user);

        $crags = [];
        $gyms = [];

        foreach ($crosses as $cross) {
            if (!isset($crags[$cross->route->crag->id])) $crags[$cross->route->crag->id] = $cross->route->crag;
        }

        foreach ($indoorCrosses as $cross) {
            if (!isset($gyms[$cross->gym->id])) $gyms[$cross->gym->id] = $cross->gym;
        }

        $data = [
            'crags' => array_values($crags),
            'gyms' => array_values($gyms),
        ];

        return response()->json($data);
    }
}
