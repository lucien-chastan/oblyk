<?php

namespace App\Http\Controllers\CRUD;

use App\Contest;
use App\ContestUser;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ContestUserController extends Controller
{
    // Display edit/create popup
    function contestUserModal(Request $request)
    {
        $contest = Contest::find($request->input('contest_id'));
        $user = User::find($request->input('user_id'));

        $id = $request->input('id');
        if (isset($id)) {
            $contestUser = ContestUser::find($id);
            $callback = $request->input('callback') ?? 'reloadCurrentVue';
        } else {
            $contestUser = new ContestUser();
            $callback = $request->input('callback') ?? 'reloadCurrentVue';
        }

        // Define save path
        $outputRoute = ($request->input('method') == 'POST') ? '/contestUsers' : '/contestUsers/' . $id;

        $showMoreInfo = (!$user->hasFirstName() || !$user->hasLastName() || !$user->hasCoherentAge() || !$user->sexIsDefined());

        $data = [
            'dataModal' => [
                'id' => $id,
                'contestUser' => $contestUser,
                'user_id' => $request->input('user_id'),
                'contest_id' => $request->input('contest_id'),
                'contest' => $contest,
                'user' => $user,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback,
                'showMoreInfo' => $showMoreInfo,
            ]
        ];

        return view('modal.contest-user', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find($request->input('user_id'));

        if (!$user->hasFirstName() && $request->input('first_name') == '') {
            return response()->json(['error' => "Vous devez compléter votre pénom"], 422);
        } elseif (!$user->hasFirstName()) {
            $user->first_name = $request->input('first_name');
        }

        if (!$user->hasLastName() && $request->input('last_name') == '') {
            return response()->json(['error' => "Vous devez compléter votre nom de famille"], 422);
        } elseif (!$user->hasLastName()) {
            $user->last_name = $request->input('last_name');
        }

        if (!$user->hasCoherentAge()) {
            $user->birth = $request->input('birth');
            if(!$user->hasCoherentAge()) {
                return response()->json(['error' => "Vous devez donner un age cohérent"], 422);
            } else {
                $user->birth = $request->input('birth');
            }
        }

        if (!$user->sexIsDefined() && $request->input('sex') == 0) {
            return response()->json(['error' => "Vous devez nous donner votre genre"], 422);
        } elseif (!$user->sexIsDefined()) {
            $user->sex = $request->input('sex');
        }

        $user->save();

        $contestUser = new ContestUser();
        $contestUser->user_id = $request->input('user_id');
        $contestUser->contest_id = $request->input('contest_id');
        $contestUser->save();

        return response()->json(json_encode($contestUser));
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
        $contestUser = ContestUser::find($id);
        $contestUser->delete();
        return response()->json(json_encode($contestUser));
    }
}
