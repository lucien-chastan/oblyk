<?php

namespace App\Http\Controllers\CRUD;

use App\GymAdministrator;
use App\GymGrade;
use App\GymGradeLine;
use App\Lib\Grade;
use App\Route;
use App\GymRoom;
use App\GymRoute;
use App\GymSector;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GymRouteController extends Controller
{
    private $gradePattern = '/(([1-9][abc]?)|(B[0-9]|B1[0-6])|(E[0-9]|E1[0-1])|(PD|AD|D|TD|ED|ABO)|([I]{1,3}|IV|V[III]{0,3}|IX|X[III]{0,3})|(M|D|VD|S|HS|VS|HVS)|(VB|V[0-9]|V1[0-9]|V20)|(A[0-6])|(5\.[0-9]|5\.1[0-5][abcd]))/';
    private $subGradePattern = '/(\/\-|\/\+|\?|\+\/\?|\-\/\?|\+\/b|\+\/c|\+|\-)/';

    // Display Create / Update modal
    function gymRouteModal(Request $request)
    {
        $GymRoute = GymRoute::class;
        $GymSector = GymSector::class;
        $GymRoom = GymRoom::class;
        $GymGrade = GymGrade::class;

        $sector = $GymSector::find($request->input('sector_id'));
        $room = $GymRoom::find($sector->room_id);
        $gradeSystem = $GymGrade::where('id', $sector->gym_grade_id ?? $room->gym_grade_id)->with('gradeLines')->first();

        $id = $request->input('id');
        if (isset($id)) {
            $gymRoute = $GymRoute::where('id', $id)->first();
            $callback = $request->input('callback') ?? 'reloadCurrentVue';
            $colors = $gymRoute->hold_colors();
            $estimateGradeLevel = $gymRoute->estimateGradeLevel($gradeSystem->id);
        } else {
            $firstGrade = (count($gradeSystem->gradeLines) > 0) ? $gradeSystem->gradeLines[0]->grade_val : 0;
            $gymRoute = new GymRoute();
            $gymRoute->label = $request->input('label');
            $gymRoute->sector_id = $request->input('sector_id');
            $gymRoute->ref = $request->input('ref');
            $gymRoute->height = $request->input('height') ?? $sector->height;
            $gymRoute->description = $request->input('description');
            $gymRoute->sector_id = $request->input('sector_id') ?? $sector->id;
            $gymRoute->type = $request->input('type') ?? $sector->preferred_type;
            $gymRoute->opener_date = new \DateTime();
            $gymRoute->gym_grade_id = $gradeSystem->id;
            $gymRoute->gym_grade_line_id = (count($gradeSystem->gradeLines) > 0) ? $gradeSystem->gradeLines[0]->id : 0;
            $callback = $request->input('callback') ?? 'reloadCurrentVue';
            $colors = (count($gradeSystem->gradeLines) > 0 && $gradeSystem->difficulty_system != 3) ? $gradeSystem->gradeLines[0]->colors() : [];
            $gymRoute->grade = ($firstGrade != 0) ? Route::valToGrad($gradeSystem->gradeLines[0]->grade_val, true) : '';
            $estimateGradeLevel = (count($gradeSystem->gradeLines) > 0) ? $gradeSystem->gradeLines[0]->id : 0;
        }

        $secondColor = (count($colors) > 1);

        // Output method
        $outputRoute = ($request->input('method') == 'POST') ? '/gym_routes' : '/gym_routes/' . $id;

        $data = [
            'gym_route' => $gymRoute,
            'room_id' => $sector->room_id,
            'gym_id' => $request->input('gym_id'),
            'sector_id' => $request->input('sector_id'),
            'title' => $request->input('title'),
            'method' => $request->input('method'),
            'route' => $outputRoute,
            'room' => $room,
            'sector' => $sector,
            'callback' => $callback,
            'colors' => $colors,
            'use_second_color' => $secondColor,
            'estimateGradeLevel' => $estimateGradeLevel,
            'gradeSystem' => $gradeSystem
        ];

        return view('modal.gym-route', $data);
    }

    function uploadRoutePictureModal(Request $request, $gym_id, $route_id)
    {
        $GymRoute = GymRoute::class;

        $gymRoute = $GymRoute::find($route_id);

        $data = [
            'dataModal' => [
                'route_id' => $gymRoute->id,
                'gym_id' => $gym_id,
                'title' => $request->input('title'),
                'callback' => $request->input('callback') ?? 'reloadCurrentVue'
            ]
        ];

        return view('modal.room-route', $data);
    }

    function cropGymRouteModal(Request $request, $gym_id, $route_id)
    {
        $GymRoute = GymRoute::class;
        $gymRoute = $GymRoute::find($route_id);

        $data = [
            'dataModal' => [
                'route' => $gymRoute,
                'route_id' => $gymRoute->id,
                'gym_id' => $gym_id,
                'method' => $request->input('method'),
                'title' => $request->input('title'),
                'callback' => $request->input('callback') ?? 'reloadCurrentVue'
            ]
        ];

        return view('modal.crop-gym-route', $data);
    }

    function uploadCropThumbnail(Request $request, $gym_id, $route_id)
    {
        $GymRoute = GymRoute::class;
        $gymRoute = $GymRoute::find($route_id);

        if ($request->input('base64')) {
            try {
                Image::make($request->input('base64'))
                    ->fit(50, 50)
                    ->save(storage_path('app/public/gyms/routes/100/thumbnail-' . $gymRoute->id . '.jpg'));
            } catch (\Exception $e) {
                // If there is a problem, we delete the downloaded images
                if (file_exists(storage_path('app/public/gyms/routes/100/thumbnail-' . $gymRoute->id . '.jpg'))) unlink(storage_path('app/public/gyms/routes/100/thumbnail-' . $gymRoute->id . '.jpg'));
            }
        }

        return response()->json(json_encode($gymRoute));
    }

    function uploadRouteThumbnailModal(Request $request, $gym_id, $route_id)
    {
        $GymRoute = GymRoute::class;

        $gymRoute = $GymRoute::find($route_id);

        $data = [
            'dataModal' => [
                'route_id' => $gymRoute->id,
                'gym_id' => $gym_id,
                'title' => $request->input('title'),
                'callback' => $request->input('callback') ?? 'reloadCurrentVue'
            ]
        ];

        return view('modal.room-route-thumbnail', $data);
    }

    function uploadRoutePicture(Request $request)
    {
        $GymRoute = GymRoute::class;

        // Valid form
        $this->validate($request, ['id' => 'required|integer']);

        $gymRoute = $GymRoute::find($request->input('id'));

        if ($request->hasFile('file')) {

            try {
                // 1300px version
                $scheme = Image::make($request->file('file'))
                    ->resize(1300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->encode('jpg', 85)
                    ->save(storage_path('app/public/gyms/routes/1300/route-' . $gymRoute->id . '.jpg'));

                // 100px * 100px version
                $scheme->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/gyms/routes/500/route-' . $gymRoute->id . '.jpg'));

                $scheme->fit(200, 200)->save(storage_path('app/public/gyms/routes/200/route-' . $gymRoute->id . '.jpg'));
                $scheme->fit(50, 50)->save(storage_path('app/public/gyms/routes/50/route-' . $gymRoute->id . '.jpg'));

            } catch (\Exception $e) {

                // If there is a problem, we delete the downloaded images
                if (file_exists(storage_path('app/public/gyms/routes/1300/route-' . $gymRoute->id . '.jpg'))) unlink(storage_path('app/public/gyms/routes/1300/route-' . $gymRoute->id . '.jpg'));
                if (file_exists(storage_path('app/public/gyms/routes/500/route-' . $gymRoute->id . '.jpg'))) unlink(storage_path('app/public/gyms/routes/500/route-' . $gymRoute->id . '.jpg'));
                if (file_exists(storage_path('app/public/gyms/routes/200/route-' . $gymRoute->id . '.jpg'))) unlink(storage_path('app/public/gyms/routes/200/route-' . $gymRoute->id . '.jpg'));
                if (file_exists(storage_path('app/public/gyms/routes/50/route-' . $gymRoute->id . '.jpg'))) unlink(storage_path('app/public/gyms/routes/50/route-' . $gymRoute->id . '.jpg'));

            }
        }

        return response()->json(json_encode($gymRoute));
    }

    function uploadRouteThumbnail(Request $request)
    {
        $GymRoute = GymRoute::class;

        // Valid form
        $this->validate($request, ['id' => 'required|integer']);

        $gymRoute = $GymRoute::find($request->input('id'));

        if ($request->hasFile('file')) {

            try {
                Image::make($request->file('file'))
                    ->fit(50, 50)
                    ->save(storage_path('app/public/gyms/routes/100/thumbnail-' . $gymRoute->id . '.jpg'));

            } catch (\Exception $e) {

                // If there is a problem, we delete the downloaded images
                if (file_exists(storage_path('app/public/gyms/routes/100/thumbnail-' . $gymRoute->id . '.jpg'))) unlink(storage_path('app/public/gyms/routes/100/thumbnail-' . $gymRoute->id . '.jpg'));

            }
        }

        return response()->json(json_encode($gymRoute));
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
        $this->checkIsAdmin($request->input('gym_id'));

        // Valid form
        $this->validate($request,
            [
                'opener_date' => 'required'
            ]
        );

        // Extract grade and sub grade from grade
        $grades = explode(';', $request->input('grade'));
        foreach ($grades as $grade) {
            if (!Grade::isGrade($grade, true)) {
                return response()->json(['error' => "Le format de cotation n'est pas reconnu"], 422);
            }
            $firstGrade = preg_replace($this->subGradePattern, '', $grade);
            $subGrade = preg_replace($this->gradePattern, '', $grade);
            $routeGrades[] = $firstGrade;
            $routeSubGrades[] = $subGrade;
            $routeValGrades[] = Route::gradeToVal($firstGrade, $subGrade);
        }

        if (count($grades) != count(explode(';', $request->input('height')))) {
            return response()->json(['error' => "Le nombre de longueur n'est pas égale au nombre de cotation"], 422);
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

        $gradeLine = GymGradeLine::find($request->input('gym_grade_line_id'));

        // Create and save new route
        $gymRoute = new GymRoute();
        $gymRoute->sector_id = $request->input('sector_id');
        $gymRoute->reference = $request->input('reference');
        $gymRoute->label = $request->input('label');
        $gymRoute->grade = implode(';', $routeGrades);
        $gymRoute->sub_grade = implode(';', $routeSubGrades);
        $gymRoute->val_grade = implode(';', $routeValGrades);
        $gymRoute->description = $request->input('description');
        $gymRoute->type = $request->input('type');
        $gymRoute->height = $request->input('height');
        $gymRoute->opener = $request->input('opener');
        $gymRoute->opener_date = $request->input('opener_date');
        $gymRoute->color_hold = join(';', $colors);
        $gymRoute->color_tag = isset($gradeLine) ? $gradeLine->color : null;
        $gymRoute->gym_grade_id = isset($gradeLine) ? $gradeLine->gym_grade_id : null;
        $gymRoute->gym_grade_line_id = isset($gradeLine) ? $gradeLine->id : null;
        $gymRoute->save();

        return response()->json(json_encode($gymRoute));
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
        $this->checkIsAdmin($request->input('gym_id'));
        $GymRoute = GymRoute::class;

        // Valid form
        $this->validate($request,
            [
                'opener_date' => 'required'
            ]
        );

        // Extract grade and sub grade from grade
        $grades = explode(';', $request->input('grade'));
        foreach ($grades as $grade) {
            if (!Grade::isGrade($grade, true)) {
                return response()->json(['error' => "Le format de cotation n'est pas reconnu"], 422);
            }
            $firstGrade = preg_replace($this->subGradePattern, '', $grade);
            $subGrade = preg_replace($this->gradePattern, '', $grade);
            $routeGrades[] = $firstGrade;
            $routeSubGrades[] = $subGrade;
            $routeValGrades[] = Route::gradeToVal($firstGrade, $subGrade);
        }

        if (count($grades) != count(explode(';', $request->input('height')))) {
            return response()->json(['error' => "Le nombre de longueur n'est pas égale au nombre de cotation"], 422);
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

        $gradeLine = GymGradeLine::find($request->input('gym_grade_line_id'));

        // Create and save new route
        $gymRoute = $GymRoute::find($request->input('id'));
        $gymRoute->sector_id = $request->input('sector_id');
        $gymRoute->reference = $request->input('reference');
        $gymRoute->label = $request->input('label');
        $gymRoute->grade = implode(';', $routeGrades);
        $gymRoute->sub_grade = implode(';', $routeSubGrades);
        $gymRoute->val_grade = implode(';', $routeValGrades);
        $gymRoute->description = $request->input('description');
        $gymRoute->type = $request->input('type');
        $gymRoute->height = $request->input('height');
        $gymRoute->opener = $request->input('opener');
        $gymRoute->opener_date = $request->input('opener_date');
        $gymRoute->color_hold = join(';', $colors);
        $gymRoute->color_tag = isset($gradeLine) ? $gradeLine->color : null;
        $gymRoute->gym_grade_id = isset($gradeLine) ? $gradeLine->gym_grade_id : null;
        $gymRoute->gym_grade_line_id = isset($gradeLine) ? $gradeLine->id : null;
        $gymRoute->save();

        return response()->json(json_encode($gymRoute));
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
        $GymRoute = GymRoute::class;
        $GymRoom = GymRoom::class;

        $gymRoute = $GymRoute::find($id);

        $this->checkIsAdmin($GymRoom::find($gymRoute->room_id)->id);

        $gymRoute->delete();

        return response()->json(json_encode($gymRoute));
    }

    /**
     * @param $route_id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function dismountRoute($route_id)
    {
        $GymRoute = GymRoute::class;

        $gymRoute = $GymRoute::where('id', $route_id)->with('sector.room')->first();

        $this->checkIsAdmin($gymRoute->sector->room->gym_id);

        if ($gymRoute->dismounted_at == null) {
            $gymRoute->dismounted_at = new \DateTime();
        } else {
            $gymRoute->dismounted_at = null;
        }
        $gymRoute->save();

        return response()->json(json_encode($gymRoute));
    }

    /**
     * @param $route_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function favoriteRoute($route_id)
    {
        $GymRoute = GymRoute::class;

        $gymRoute = $GymRoute::where('id', $route_id)->with('sector.room')->first();

        $this->checkIsAdmin($gymRoute->sector->room->gym_id);

        $gymRoute->favorite = !$gymRoute->favorite;
        $gymRoute->save();

        return response()->json(json_encode($gymRoute));
    }

    public function saveSchemeLine($gym_id, $route_id, Request $request)
    {
        $GymRoute = GymRoute::class;

        $route = $GymRoute::find($route_id);
        $route->line = $request->input('line');
        $route->save();
    }

    public function deleteSchemeLine($gym_id, $route_id, Request $request)
    {
        $GymRoute = GymRoute::class;

        $route = $GymRoute::find($route_id);
        $route->line = null;
        $route->save();
    }

    public function deletePhoto($route_id)
    {
        $route = GymRoute::where('id', $route_id)->with('sector.room')->first();
        $this->checkIsAdmin($route->sector->room->gym_id);

        if (file_exists(storage_path('app/public/gyms/routes/1300/route-' . $route->id . '.jpg'))) unlink(storage_path('app/public/gyms/routes/1300/route-' . $route->id . '.jpg'));
        if (file_exists(storage_path('app/public/gyms/routes/500/route-' . $route->id . '.jpg'))) unlink(storage_path('app/public/gyms/routes/500/route-' . $route->id . '.jpg'));
        if (file_exists(storage_path('app/public/gyms/routes/200/route-' . $route->id . '.jpg'))) unlink(storage_path('app/public/gyms/routes/200/route-' . $route->id . '.jpg'));
        if (file_exists(storage_path('app/public/gyms/routes/100/route-' . $route->id . '.jpg'))) unlink(storage_path('app/public/gyms/routes/100/route-' . $route->id . '.jpg'));
        if (file_exists(storage_path('app/public/gyms/routes/50/route-' . $route->id . '.jpg'))) unlink(storage_path('app/public/gyms/routes/50/route-' . $route->id . '.jpg'));
    }

    /**
     * @param $gym_id
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    private function checkIsAdmin($gym_id)
    {
        $GymAdministrator = GymAdministrator::class;

        $isAdministrator = $GymAdministrator::where([['user_id', Auth::id()], ['gym_id', $gym_id]])->exists();
        if (!$isAdministrator) {
            return redirect()->route('index');
        }
        return true;
    }
}
