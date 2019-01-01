<?php

namespace App\Http\Controllers\API;

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

        $gymGradeLine = $GymGradeLine::where('id', $id)
            ->select($this->gradeLineDbAttributes)
            ->first();

        $gymGradeLine->grade = Route::valToGrad($gymGradeLine->grade_val, true);
        $gymGradeLine->colors();
        $gymGradeLine->useSecondColor = (count($gymGradeLine->colors) > 1);

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
