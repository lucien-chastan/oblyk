<?php

namespace App\Http\Controllers\API;

use App\GymGrade;
use App\GymGradeLine;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\GymGrade\GetGradeLineByIdRequest;
use App\Route;
use Illuminate\Http\JsonResponse;

/**
 * @resource GymGradeLine
 *
 * Routes to retrieve information on gym grade system
 */
class ApiGymGradeController extends Controller
{
    private $gradeLineDbAttributes = [
        'id',
        'gym_grade_id',
        'label',
        'color',
        'grade_val',
        'order',
    ];

    /**
     * @param $id
     * @return GymGradeLine
     */
    private function getGradeLine($id) : GymGradeLine
    {
        $GymGradeLine = GymGradeLine::class;
        $GymGrade = GymGrade::class;

        $gymGradeLine = $GymGradeLine::where('id', $id)
            ->select($this->gradeLineDbAttributes)
            ->first();

        $gymGrade = $GymGrade::find($gymGradeLine->gym_grade_id);

        $gymGradeLine->grade = ($gymGradeLine->grade_val != 0) ? Route::valToGrad($gymGradeLine->grade_val, true) : '';
        $gymGradeLine->colors();
        $gymGradeLine->useSecondColor = (count($gymGradeLine->colors) > 1);
        $gymGradeLine->changeHoldColor = !$gymGrade->needs_to_define_holds_color() && $gymGrade->difficulty_system != 3;

        return $gymGradeLine;
    }

    /**
     * GET : gym grade line system
     *
     * Get gym grade line system : label, colors, grade & grade_val, etc. by id
     *
     * @param GetGradeLineByIdRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGradeLineResponse(GetGradeLineByIdRequest $request, $id) : JsonResponse
    {
        return response()->json(['data' => $this->getGradeLine($id)]);
    }

}
