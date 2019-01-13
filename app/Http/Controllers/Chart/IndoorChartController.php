<?php

namespace App\Http\Controllers\Chart;

use App\Http\Controllers\Controller;
use App\IndoorCross;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndoorChartController extends Controller
{

    // Grade chart
    function grades(Request $request){
        $Crosses = IndoorCross::class;

        $crosses = $Crosses::where([['gym_id', $request->input('gym')], ['user_id', Auth::id()]])->get();

        $gradeArray = [
            1  => 0,3  => 0,5  => 0,
            7  => 0,9  => 0,11 => 0,
            13 => 0,15 => 0,17 => 0,
            19 => 0,21 => 0,23 => 0,
            25 => 0,27 => 0,29 => 0,
            31 => 0,33 => 0,35 => 0,
            37 => 0,39 => 0,41 => 0,
            43 => 0,45 => 0,47 => 0,
            49 => 0,51 => 0,53 => 0,
        ];

        foreach ($crosses as $cross){
            if($cross->grade_val % 2 == 0) $cross->grade_val--;
            if($cross->grade_val > 0) $gradeArray[$cross->grade_val]++;
        }

        $data = [
            'type'=>'bar',
            'data'=> [
                'labels' => [
                    "1a", "1b", "1c",
                    "2a", "2b", "2c",
                    "3a", "3b", "3c",
                    "4a", "4b", "4c",
                    "5a", "5b", "5c",
                    "6a", "6b", "6c",
                    "7a", "7b", "7c",
                    "8a", "8b", "8c",
                    "9a", "9b", "9c",
                ],
                'datasets' => [
                    [
                        'label' => '',
                        'data' => [
                            $gradeArray[1], $gradeArray[3], $gradeArray[5],
                            $gradeArray[7], $gradeArray[9], $gradeArray[11],
                            $gradeArray[13], $gradeArray[15], $gradeArray[17],
                            $gradeArray[19], $gradeArray[21], $gradeArray[23],
                            $gradeArray[25], $gradeArray[27], $gradeArray[29],
                            $gradeArray[31], $gradeArray[33], $gradeArray[35],
                            $gradeArray[37], $gradeArray[39], $gradeArray[41],
                            $gradeArray[43], $gradeArray[45], $gradeArray[47],
                            $gradeArray[49], $gradeArray[51], $gradeArray[53],
                        ],
                        'backgroundColor' => [
                            'rgb(255,85,220)', 'rgb(238,51,201)', 'rgb(221,17,180)',
                            'rgb(134,205,222)','rgb(103,191,213)', 'rgb(71,178,204)',
                            'rgb(255,221,84)', 'rgb(249,208,51)', 'rgb(243,195,17)',
                            'rgb(255,127,42)', 'rgb(238,110,25)', 'rgb(221,93,8)',
                            'rgb(170,212,0)', 'rgb(143,178,0)', 'rgb(115,144,0)',
                            'rgb(0,85,212)', 'rgb(0,64,161)', 'rgb(0,44,110)',
                            'rgb(171,55,200)', 'rgb(144,46,168)', 'rgb(117,37,136)',
                            'rgb(255,42,42)', 'rgb(221,25,25)', 'rgb(187,8,8)',
                            'rgb(128,128,128)', 'rgb(77,77,77)', 'rgb(25,25,25)',
                        ]
                    ]
                ]
            ],
            'options' => [
                'maintainAspectRatio' => false,
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true,
                                'step' => 1,
                                'stepSize' => 1,
                            ]
                        ]
                    ]
                ],
                'legend' => [
                    'display' => false
                ]
            ]
        ];

        return response()->json($data);
    }

    // Time chart
    function time(Request $request){
        $Crosses = IndoorCross::class;

        $crosses = $Crosses::where([['gym_id', $request->input('gym')], ['user_id', Auth::id()]])->get();

        $firstCross = $Crosses::where([['gym_id', $request->input('gym')], ['user_id', Auth::id()]])->orderBy('release_at')->first();
        $start = $firstCross->release_at;
        $end = Carbon::now();

        $firstCrosse = $Crosses::where([['gym_id', $request->input('gym')], ['user_id', Auth::id()],['release_at','>=',$start]])->orderBy('release_at')->first();
        $lastCrosse = $Crosses::where([['gym_id', $request->input('gym')], ['user_id', Auth::id()],['release_at','<=',$end]])->orderBy('release_at', 'DESC')->first();

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

        return response()->json($data);
    }
}
