<?php

namespace App\Http\Controllers\Chart\Crosses;

use App\Cross;
use App\CrossMode;
use App\CrossStatus;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class timeChartsController extends Controller
{

    //GRAPHIQUE DES TYPES DE GRIMPE
    function timeLines(){

        $user = User::where('id', Auth::id())->with('settings')->first();
        $crosses = Cross::getCrossWithFilter($user);

        $periods = json_decode($user->settings->filter_period);
        $filter_periods = [];
        foreach ($periods as $key => $period) $filter_periods[$key] = $period;

        if($filter_periods['start'] != 'first' && $filter_periods['end'] != 'now'){
            $start = $filter_periods['start'];
            $end = $filter_periods['end'];
        }else{
            $firstCross = Cross::where('user_id',$user->id)->orderBy('release_at')->first();
            $start = $firstCross->release_at;
            $end = Carbon::now();
        }

        $firstCrosse = Cross::where([['user_id',Auth::id()],['release_at','>=',$start]])->orderBy('release_at')->first();
        $lastCrosse = Cross::where([['user_id',Auth::id()],['release_at','<=',$end]])->orderBy('release_at', 'DESC')->first();

        $firstTime = $firstCrosse->release_at->format('Ym');
        $lastTime = $lastCrosse->release_at->format('Ym');

        $labels = [];
        $datas = [];
        $months = ['01'=>'Jan', '02'=>'Fév', '03'=>'Mar', '04'=>'Avr', '05'=>'Mai', '06'=>'Jui', '07'=>'Jul', '08'=>'Aou', '09'=>'Sep', '10'=>'Oct', '11'=>'Nov', '12'=>'Déc'];

        while ($firstTime <= $lastTime) {
            $datas[$firstTime] = 0;
            $labels[$firstTime] = $months[substr($firstTime, -2)] . ' ' . substr($firstTime, 0, 4);
            $firstTime = substr($firstTime, -2) != 12 ? $firstTime + 1 : substr($firstTime, 0, 4) + 1 . '01';
        }

        foreach ($crosses as $cross) $datas[$cross->release_at->format('Ym')]++;


        //réindex à partir de zéro
        $labels = array_values($labels);
        $datas = array_values($datas);

        $data = [
            'type'=>'line',
            'data'=> [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => '',
                        'data' => $datas,
                        'borderColor' => '#2196F3',
                        'backgroundColor' => 'rgba(255,255,255,0)'
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
                                'suggestedMin'=> 0,
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

    //GRAPHIQUE DES TYPES DE GRIMPE
    function years(){

        $user = User::where('id', Auth::id())->with('settings')->first();
        $crosses = Cross::getCrossWithFilter($user);

        $datas = [];
        $labels = [];

        foreach ($crosses as $cross){
            $labels[$cross->release_at->format('Y')] = $cross->release_at->format('Y');
            if(isset($datas[$cross->release_at->format('Y')])){
                $datas[$cross->release_at->format('Y')]++;
            }else{
                $datas[$cross->release_at->format('Y')] = 1;
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
                    'display' => false,
                    'yAxes' => [
                        [
                            'ticks' => [
                                'suggestedMin'=> 0,
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


    //GRAPHIQUE DES TYPES DE GRIMPE
    function months(){

        $user = User::where('id', Auth::id())->with('settings')->first();
        $crosses = Cross::getCrossWithFilter($user);

        $datas = ['1'=>0, '2'=>0, '3'=>0, '4'=>0, '5'=>0, '6'=>0, '7'=>0, '8'=>0, '9'=>0, '10'=>0, '11'=>0, '12'=>0];
        $labels = ['Jan','Fév','Mar','Avr','Mai','Jui','Jul','Aou','Sep','Oct','Nov','Déc'];

        foreach ($crosses as $cross){
            $datas[$cross->release_at->format('n')]++;
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
                    'display' => false,
                    'yAxes' => [
                        [
                            'ticks' => [
                                'suggestedMin'=> 0,
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

}
