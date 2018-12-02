<?php

namespace App\Http\Controllers\CRUD;

use App\GymAdministrator;
use App\GymGrade;
use App\GymGradeLine;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GymGradeLineController extends Controller
{

    // Display edit/create popup
    function gymGradeLineModal(Request $request)
    {
        $GymGradeLine = GymGradeLine::class;

        $id = $request->input('id');
        if (isset($id)) {
            $gradeLine = $GymGradeLine::find($id);
            $colors = explode(';', $gradeLine->color);
            $callback = $request->input('callback') ?? 'reloadCurrentVue';
        } else {
            $newOrder = $GymGradeLine::where('gym_grade_id', $request->input('gym_grade_id'))->max('order') + 1;
            $gradeLine = new GymGradeLine();
            $gradeLine->order = $newOrder;
            $colors = ['#ffffff'];
            $callback = $request->input('callback') ?? 'reloadCurrentVue';
        }

        // Define save path
        $outputRoute = ($request->input('method') == 'POST') ? '/gym_grade_lines' : '/gym_grade_lines/' . $id;

        $data = [
            'dataModal' => [
                'id' => $id,
                'gym_grade_line' => $gradeLine,
                'gym_grade_id' => $request->input('gym_grade_id'),
                'gym_id' => $request->input('gym_id'),
                'colors' => $colors,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'use_second_color' => (isset($colors[1]) && $colors[1] != '') ? 1 : 0,
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.gym-grade-line', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkIsAdmin($request->input('gym_id'));

        // Form validation
        $this->validate($request, ['label' => 'String|max:255']);

        $use_second_color = $request->input('use_second_color');

        $colors[] = $request->input('color_first');
        if (isset($use_second_color) && $use_second_color == 1) $colors[] = $request->input('color_second');

        $gradeLine = new GymGradeLine();
        $gradeLine->gym_grade_id = $request->input('gym_grade_id');
        $gradeLine->label = $request->input('label');
        $gradeLine->order = $request->input('order');
        $gradeLine->color = join(';', $colors);
        $gradeLine->grade_val = $request->input('grade_val');
        $gradeLine->save();

        return response()->json(json_encode($gradeLine));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $GymGradeLine = GymGradeLine::class;
        $gradeLine = $GymGradeLine::find($request->input('id'));

        // Form validation
        $this->validate($request, ['label' => 'String|max:255',]);

        // Checks if user is an administrator
        $this->checkIsAdmin($request->input('gym_id'));

        $use_second_color = $request->input('use_second_color');

        $colors[] = $request->input('color_first');
        if (isset($use_second_color) && $use_second_color == 1) $colors[] = $request->input('color_second');

        $gradeLine->label = $request->input('label');
        $gradeLine->order = $request->input('order');
        $gradeLine->color = join(';', $colors);
        $gradeLine->grade_val = $request->input('grade_val');
        $gradeLine->save();

        return response()->json(json_encode($gradeLine));
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
        $GymGradeLine = GymGradeLine::class;
        $GymGrade = GymGrade::class;
        $gradeLine = $GymGradeLine::find($id);
        $grade = $GymGrade::find($gradeLine->gym_grade_id);

        // Checks is user is an administrator
        $this->checkIsAdmin($grade->gym_id);

        $gradeLine->delete();

        return response()->json(json_encode($gradeLine));
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
