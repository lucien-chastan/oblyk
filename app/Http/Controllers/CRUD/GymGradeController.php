<?php

namespace App\Http\Controllers\CRUD;

use App\GymAdministrator;
use App\GymGrade;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class GymGradeController extends Controller
{

    // Display edit/create popup
    function gymGradeModal(Request $request)
    {
        $GymGrade = GymGrade::class;

        $id = $request->input('id');
        if (isset($id)) {
            $grade = $GymGrade::find($id);
            $callback = $request->input('callback') ?? 'reloadCurrentVue';
        } else {
            $grade = new GymGrade();
            $callback = $request->input('callback') ?? 'reloadCurrentVue';
        }

        // Define save path
        $outputRoute = ($request->input('method') == 'POST') ? '/gym_grades' : '/gym_grades/' . $id;

        $data = [
            'dataModal' => [
                'id' => $id,
                'gym_grade' => $grade,
                'gym_id' => $request->input('gym_id'),
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.gym-grade', $data);
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

        // Form validation
        $this->validate($request, ['label' => 'String|max:255']);

        $grade = new GymGrade();
        $grade->gym_id = $request->input('gym_id');
        $grade->label = $request->input('label');
        $grade->difficulty_system = $request->input('difficulty_system');
        $grade->updateDifficultySystem();
        $grade->save();


        return response()->json(json_encode($grade));
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
        $GymGrade = GymGrade::class;
        $grade = $GymGrade::find($request->input('id'));

        // Form validation
        $this->validate($request, ['label' => 'String|max:255',]);

        // Checks if user is an administrator
        $this->checkIsAdmin($request->input('gym_id'));

        $grade->label = $request->input('label');
        $grade->difficulty_system = $request->input('difficulty_system');
        $grade->updateDifficultySystem();
        $grade->save();


        return response()->json(json_encode($grade));
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
        $GymGrade = GymGrade::class;
        $grade = $GymGrade::find($id);

        // Checks is user is an administrator
        $this->checkIsAdmin($grade->gym_id);

        $grade->delete();

        return response()->json(json_encode($grade));
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
