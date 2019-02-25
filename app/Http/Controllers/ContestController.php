<?php

namespace App\Http\Controllers;

use App\Contest;
use App\ContestUser;
use Illuminate\Support\Facades\Auth;

class ContestController extends Controller
{
    function contestPage($contest_id, $contest_label){

        $contest = Contest::where('id', $contest_id)
            ->with('contestUsers')
            ->with('contestRoutes')
            ->with('gym')
            ->first();

        // If the label has changed
        if(Contest::webUrl($contest_id, $contest_label) != $contest->url()) {
            return $this->contestRedirectionPage($contest_id);
        }

        if(Auth::check()) {
            $authUser = Auth::user();
            $authUserIsRegistered = $authUser->registeredOnContest($contest->id);
            if($authUserIsRegistered) {
                $contestAuthUser = ContestUser::where([['user_id', $authUser->id], ['contest_id', $contest->id]])->first();
            }
        }

        $data = [
            'contest' => $contest,
            'gym' => $contest->gym,
            'authUserIsRegistered' => $authUserIsRegistered ?? false,
            'contestAuthUser' => $contestAuthUser ?? null,
        ];

        return view('pages.contest.contest', $data);
    }

    public function contestRedirectionPage($contest_id) {
        $contest = Contest::find($contest_id);
        return redirect($contest->url(),301);
    }
}
