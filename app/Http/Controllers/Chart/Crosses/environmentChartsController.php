<?php

namespace App\Http\Controllers\Chart\Crosses;

use App\Cross;
use App\Http\Controllers\Controller;
use App\Rock;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class environmentChartsController extends Controller
{


    //GRAPHIQUE DES SITES D'ESCALADES
    function crags(){

        $user = User::where('id', Auth::id())->with('settings')->first();
        $crosses = Cross::getCrossWithFilter($user);

        $cragsData = [];
        $cragsLabel = [];

        foreach ($crosses as $cross){
            $cragsLabel[$cross->route->crag->id] = $cross->route->crag->label;
            if(isset($cragsData[$cross->route->crag->id])){
                $cragsData[$cross->route->crag->id]++;
            }else{
                $cragsData[$cross->route->crag->id] = 1;
            }
        }

        //réindex à partir de zéro
        $cragsLabel = array_values($cragsLabel);
        $cragsData = array_values($cragsData);

        $data = [
            'type'=>'bar',
            'data'=> [
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
                    'display' => false
                ],
                'legend' => [
                    'display' => false
                ]
            ]
        ];

        return response()->json(json_encode($data));
    }



    function regions(){

        $user = User::where('id', Auth::id())->with('settings')->first();
        $crosses = Cross::getCrossWithFilter($user);

        $datas = [];
        $labels = [];

        foreach ($crosses as $cross){
            $labels[$cross->route->crag->id] = $cross->route->crag->region;
            if(isset($datas[$cross->route->crag->id])){
                $datas[$cross->route->crag->id]++;
            }else{
                $datas[$cross->route->crag->id] = 1;
            }
        }

        //réindex à partir de zéro
        $labels = array_values($labels);
        $datas = array_values($datas);

        $data = [
            'type'=>'bar',
            'data'=> [
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
                    'display' => false
                ],
                'legend' => [
                    'display' => false
                ]
            ]
        ];

        return response()->json(json_encode($data));
    }


    function pays(){

        $user = User::where('id', Auth::id())->with('settings')->first();
        $crosses = Cross::getCrossWithFilter($user);

        $datas = [];
        $labels = [];

        foreach ($crosses as $cross){
            $labels[$cross->route->crag->id] = $cross->route->crag->code_country;
            if(isset($datas[$cross->route->crag->id])){
                $datas[$cross->route->crag->id]++;
            }else{
                $datas[$cross->route->crag->id] = 1;
            }
        }

        //réindex à partir de zéro
        $labels = array_values($labels);
        $datas = array_values($datas);

        $data = [
            'type'=>'bar',
            'data'=> [
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
                    'display' => false
                ],
                'legend' => [
                    'display' => false
                ]
            ]
        ];

        return response()->json(json_encode($data));
    }


    //GRAPHIQUE DES TYPES DE GRIMPE
    function rocks(){

        $user = User::where('id', Auth::id())->with('settings')->first();
        $crosses = Cross::getCrossWithFilter($user);

        $rocksData = [];
        $rocksLabel = [];
        $rocks = Rock::all();

        // Liste des labels (le -1 et pour que l'index commence à 0)
        foreach ($rocks as $rock){
            $rocksLabel[$rock->id - 1] = ucfirst($rock->label);
            $rocksData[$rock->id - 1] = 0;
        }

        // Croix par roche
        foreach ($crosses as $cross) $rocksData[$cross->route->crag->rock_id - 1]++;

        $data = [
            'type'=>'radar',
            'data'=> [
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
                    'display' => false
                ],
                'legend' => [
                    'display' => false
                ]
            ]
        ];

        return response()->json(json_encode($data));
    }


    //GRAPHIQUE DES TYPES DE GRIMPE
    function maps(){

        $user = User::where('id', Auth::id())->with('settings')->first();
        $crosses = Cross::getCrossWithFilter($user);

        $crags = [];

        foreach ($crosses as $cross){
            if(!isset($crags[$cross->route->crag->id])) $crags[$cross->route->crag->id] = $cross->route->crag;
        }

        $data = array_values($crags);

        return response()->json($data);
    }
}
