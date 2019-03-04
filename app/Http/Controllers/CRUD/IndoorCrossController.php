<?php

namespace App\Http\Controllers\CRUD;

use App\Cross;
use App\CrossSection;
use App\Description;
use App\GymRoom;
use App\GymRoute;
use App\GymSector;
use App\IndoorCross;
use App\Lib\Grade;
use App\Route;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndoorCrossController extends Controller
{
    private $gradePattern = '/(([1-9][abc]?)|(B[0-9]|B1[0-6])|(E[0-9]|E1[0-1])|(PD|AD|D|TD|ED|ABO)|([I]{1,3}|IV|V[III]{0,3}|IX|X[III]{0,3})|(M|D|VD|S|HS|VS|HVS)|(VB|V[0-9]|V1[0-9]|V20)|(A[0-6])|(5\.[0-9]|5\.1[0-5][abcd]))/';
    private $subGradePattern = '/(\/\-|\/\+|\?|\+\/\?|\-\/\?|\+\/b|\+\/c|\+|\-)/';

    // Display add/edit popup
    function indoorCrossModal(Request $request){
        $IndoorCross = IndoorCross::class;
        $GymRoute = GymRoute::class;
        $GymRoom = GymRoom::class;
        $GymSector = GymSector::class;

        $id_cross = $request->input('id');
        $route_id = $request->input('route_id');
        $sector_id = $request->input('sector_id');
        $room_id = $request->input('room_id');

        if (isset($route_id)) $route = $GymRoute::find($route_id);
        if (isset($sector_id)) $sector = $GymSector::find($sector_id);
        if (isset($room_id)) $room = $GymRoom::find($room_id);
        $pitches = [];

        // Get pitches
        if (isset($route_id) && $route->isMultiPitch()) {
            $pitches = $route->pitches();
        }

        // Get first !null height
        if (isset($route_id) && $route->height != null) {
            $height = $route->height;
        } elseif (isset($sector_id) && $sector->height != null) {
            $height = $sector->height;
        } elseif (isset($room_id) && $room->height != null) {
            $height = $room->height;
        }

        // Get line type
        if (isset($route_id) && $route->type != null) {
            $type = $route->type;
        } elseif (isset($sector_id) && $sector->preferred_type != null) {
            $type = $sector->preferred_type;
        } elseif (isset($room_id) && $room->preferred_type != null) {
            $type = $room->preferred_type;
        }

        // Get grade system
        if (isset($sector_id) && $sector->gym_grade_id != null) {
            $gym_grade_id = $sector->gym_grade_id;
        } elseif (isset($room_id) && $room->gym_grade_id != null) {
            $gym_grade_id = $room->gym_grade_id;
        } else {
            $gym_grade_id = null;
        }

        // Save or edit
        if (isset($id_cross)) {
            $cross = $IndoorCross::find($id_cross);
        } else {
            $cross = new IndoorCross();
            $cross->release_at = Carbon::now()->format('Y-m-d');
            $cross->grade = (isset($route_id)) ? $route->grade . $route->sub_grade : null;
            $cross->type = (isset($type)) ? $type : null;
            $cross->height = $height ?? null;
        }

        // Get colors
        $colors = [];
        if (isset($id_cross)) {
            $colors = $cross->hold_colors();
        } elseif (isset($route_id)) {
            $colors = $route->hold_colors();
        }

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        // Save or edit path
        $method = $request->input('method');
        $outputRoute = ($method == 'POST')? '/indoor_crosses' : '/indoor_crosses/' . $id_cross;

        $hide_color = ($method == 'POST' && isset($route_id));
        $hide_height = ($method == 'POST' && $cross->height !== null);
        $hide_grade = ($method == 'POST' && $cross->grade !== null);
        $hide_type = ($method == 'POST' && $cross->type !== null);
        $hide_mode = ($cross->type != 1);
        $show_grade_system = ($method == 'POST' && !isset($route_id));
        $show_alert = ($method == 'POST' && !isset($route_id));
        $show_pitches = ($method == 'POST' && count($pitches) > 0);

        $data = [
            'id' => $request->input('id'),
            'gym_id' => $request->input('gym_id'),
            'room_id' => $request->input('room_id'),
            'sector_id' => $request->input('sector_id'),
            'route_id' => $request->input('route_id'),
            'cross' => $cross,
            'title' => $request->input('title'),
            'method' => $method,
            'route' => $outputRoute,
            'pitches' => $pitches,
            'callback' => $callback,
            'colors' => $colors,
            'use_second_color' => (count($colors) > 1) ? 1 : 0,
            'gym_grade_id' => $gym_grade_id,
            'hide_color' => $hide_color,
            'hide_height' => $hide_height,
            'hide_grade' => $hide_grade,
            'hide_type' => $hide_type,
            'hide_mode' => $hide_mode,
            'show_grade_system' => $show_grade_system,
            'show_alert' => $show_alert,
            'show_pitches' => $show_pitches,
        ];

        return view('modal.indoor-cross', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Validation
        $this->validate($request, [
            'release_at' => 'required|date_format:Y-m-d',
            'attempt' => 'min:0',
        ]);

        $route_id = $request->input('route_id');
        $pitch = $request->input('pitch');

        // If is a multi-pitch route
        if(isset($route_id) && isset($pitch)) {
            $route = GymRoute::find($route_id);
            $pitches = $route->pitches();
            $routeGrade = $pitches[$pitch]['first_grade'];
            $routeSubGrade = $pitches[$pitch]['sub_grade'];
            $height = $pitches[$pitch]['height'];
        } else {

            // Extract grade and sub grade from grade
            $grade = $request->input('grade');
            if (!Grade::isGrade($grade) && $grade != '') {
                return response()->json(['error' => "Le format de cotation n'est pas reconnu"], 422);
            }

            $routeGrade = preg_replace($this->subGradePattern, '', $grade);
            $routeSubGrade = preg_replace($this->gradePattern, '', $grade);
            $height = $request->input('height');
        }

        // Concat colors
        $colors = [];
        $color_first = $request->input('color_first');
        $color_second = $request->input('color_second');
        if($color_first != '#00000000') {
            $colors[] = $color_first;
        }
        if ($request->input('use_second_color')) {
            if($color_second != '#00000000') {
                $colors[] = $color_second;
            }
        }

        // Save indoor cross
        $cross = new IndoorCross();
        $cross->user_id = Auth::id();
        $cross->route_id = $request->input('route_id');
        $cross->sector_id = $request->input('sector_id');
        $cross->room_id = $request->input('room_id');
        $cross->gym_id = $request->input('gym_id');
        $cross->status_id = $request->input('status_id');
        $cross->mode_id = $request->input('mode_id');
        $cross->type = $request->input('type');
        $cross->grade = $routeGrade;
        $cross->sub_grade = $routeSubGrade;
        $cross->grade_val = Route::gradeToVal($routeGrade, $routeSubGrade);
        $cross->height = $height;
        $cross->description = $request->input('description');
        $cross->release_at = $request->input('release_at');
        $cross->color = join(';', $colors);
        $cross->save();

        return response()->json(json_encode($cross));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $Cross = IndoorCross::class;

        // Validation
        $this->validate($request, [
            'release_at' => 'required|date_format:Y-m-d',
            'attempt' => 'min:0',
        ]);

        // Extract grade and sub grade from grade

        $grade = $request->input('grade');
        if (!Grade::isGrade($grade) && $grade != '') {
            return response()->json(['error' => "Le format de cotation n'est pas reconnu"], 422);
        }

        $routeGrade = preg_replace($this->subGradePattern, '', $grade);
        $routeSubGrade = preg_replace($this->gradePattern, '', $grade);

        // Concat colors
        $colors = [];
        $color_first = $request->input('color_first');
        $color_second = $request->input('color_second');
        if($color_first != '#00000000') {
            $colors[] = $color_first;
        }
        if ($request->input('use_second_color')) {
            if($color_second != '#00000000') {
                $colors[] = $color_second;
            }
        }

        // Save indoor cross
        $cross = $Cross::find($request->input('id'));
        $cross->route_id = $request->input('route_id');
        $cross->sector_id = $request->input('sector_id');
        $cross->room_id = $request->input('room_id');
        $cross->status_id = $request->input('status_id');
        $cross->mode_id = $request->input('mode_id');
        $cross->type = $request->input('type');
        $cross->grade = $routeGrade;
        $cross->sub_grade = $routeSubGrade;
        $cross->grade_val = Route::gradeToVal($routeGrade, $routeSubGrade);
        $cross->height = $request->input('height');
        $cross->description = $request->input('description');
        $cross->release_at = $request->input('release_at');
        $cross->color = join(';', $colors);
        $cross->save();

        return response()->json(json_encode($cross));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $Cross = IndoorCross::class;

        $cross = $Cross::where('id', $id)->first();
        $oldCross = $cross;
        if($cross->user_id == Auth::id()){

            //on supprime la croix
            $cross->delete();
        }

        return response()->json(json_encode($oldCross));
    }

}
