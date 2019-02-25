<?php

namespace App\Http\Controllers\CRUD;

use App\Contest;
use App\GymAdministrator;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ContestController extends Controller
{

    // Display edit/create popup
    function contestModal(Request $request)
    {
        $Contest = Contest::class;

        $id = $request->input('id');
        if (isset($id)) {
            $contest = $Contest::find($id);
            $contest->start_date = $contest->start_at->format('Y-m-d');
            $contest->start_hour = $contest->start_at->format('H');
            $contest->start_minute = $contest->start_at->format('i');
            $contest->end_date = $contest->end_at->format('Y-m-d');
            $contest->end_hour = $contest->end_at->format('H');
            $contest->end_minute = $contest->end_at->format('i');
            $callback = $request->input('callback') ?? 'reloadCurrentVue';
        } else {
            $contest = new Contest();
            $contest->real_time_result = $contest->isRealTimeResult();
            $contest->subscribers_need_validation = $contest->subscribersNeedToBeValidated();
            $contest->hide_route_before_contest = $contest->areRouteHiddenBeforeTheContest();
            $contest->minutes_after_end = 0;
            $callback = $request->input('callback') ?? 'reloadCurrentVue';
        }

        // Define save path
        $outputRoute = ($request->input('method') == 'POST') ? '/contests' : '/contests/' . $id;

        $data = [
            'dataModal' => [
                'id' => $id,
                'contest' => $contest,
                'gym_id' => $request->input('gym_id'),
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.contest', $data);
    }

    function uploadContestCoverModal(Request $request, $gym_id, $contest_id)
    {
        $contest = Contest::find($contest_id);
        $data = [
            'dataModal' => [
                'contest_id' => $contest->id,
                'gym_id' => $gym_id,
                'title' => $request->input('title'),
                'callback' => $request->input('callback') ?? 'reloadCurrentVue'
            ]
        ];

        return view('modal.contest-cover', $data);
    }

    function uploadContestCover(Request $request)
    {
        $this->validate($request, ['id' => 'required|integer']);

        $contest = Contest::find($request->input('id'));

        if ($request->hasFile('file')) {

            try {
                // 2000px version
                $scheme = Image::make($request->file('file'))
                    ->resize(1300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->encode('jpg', 85)
                    ->save(storage_path('app/public/contests/1300/contest-' . $contest->id . '.jpg'));

                // 100px * 100px version
                $scheme->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path('app/public/contests/500/contest-' . $contest->id . '.jpg'));

                $scheme->fit(200, 200)->save(storage_path('app/public/contests/200/contest-' . $contest->id . '.jpg'));
                $scheme->fit(50, 50)->save(storage_path('app/public/contests/50/contest-' . $contest->id . '.jpg'));

            } catch (\Exception $e) {

                // If there is a problem, we delete the downloaded images
                if (file_exists(storage_path('app/public/contests/1300/contest-' . $contest->id . '.jpg'))) unlink(storage_path('app/public/contests/1300/contest-' . $contest->id . '.jpg'));
                if (file_exists(storage_path('app/public/contests/500/contest-' . $contest->id . '.jpg'))) unlink(storage_path('app/public/contests/500/contest-' . $contest->id . '.jpg'));
                if (file_exists(storage_path('app/public/contests/200/contest-' . $contest->id . '.jpg'))) unlink(storage_path('app/public/contests/200/contest-' . $contest->id . '.jpg'));
                if (file_exists(storage_path('app/public/contests/50/contest-' . $contest->id . '.jpg'))) unlink(storage_path('app/public/contests/50/contest-' . $contest->id . '.jpg'));

            }
        }

        return response()->json(json_encode($contest));
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

        $start_at = $this->concatDate($request->input('start_date'), (int)$request->input('start_hour'), (int)$request->input('start_minute'));
        $end_at = $this->concatDate($request->input('end_date'), (int)$request->input('end_hour'), (int)$request->input('end_minute'));

        if($start_at > $end_at) {
            return response()->json(['error' => "Le contest ne peut commencer après qu'il soit fini"], 422);
        }

        $contest = new Contest();
        $contest->gym_id = $request->input('gym_id');
        $contest->label = $request->input('label');
        $contest->description = $request->input('description');
        $contest->start_at = $start_at;
        $contest->end_at = $end_at;
        $contest->participant_limit = $request->input('participant_limit');
        $contest->minutes_after_end = $request->input('minutes_after_end');
        $contest->real_time_result = $request->input('real_time_result');
        $contest->subscribers_need_validation = $request->input('subscribers_need_validation');
        $contest->hide_route_before_contest = $request->input('hide_route_before_contest');
        $contest->validation_message = $request->input('validation_message');
        $contest->save();

        return response()->json(json_encode($contest));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $Contest = Contest::class;
        $contest = $Contest::find($request->input('id'));

        // Form validation
        $this->validate($request, ['label' => 'String|max:255',]);

        // Checks if user is an administrator
        $this->checkIsAdmin($request->input('gym_id'));

        $start_at = $this->concatDate($request->input('start_date'), (int)$request->input('start_hour'), (int)$request->input('start_minute'));
        $end_at = $this->concatDate($request->input('end_date'), (int)$request->input('end_hour'), (int)$request->input('end_minute'));

        if($start_at > $end_at) {
            return response()->json(['error' => "Le contest ne peut commencer après qu'il soit fini"], 422);
        }

        $contest->label = $request->input('label');
        $contest->description = $request->input('description');
        $contest->start_at = $start_at;
        $contest->end_at = $end_at;
        $contest->participant_limit = $request->input('participant_limit');
        $contest->minutes_after_end = $request->input('minutes_after_end');
        $contest->real_time_result = $request->input('real_time_result');
        $contest->subscribers_need_validation = $request->input('subscribers_need_validation');
        $contest->hide_route_before_contest = $request->input('hide_route_before_contest');
        $contest->validation_message = $request->input('validation_message');
        $contest->save();

        return response()->json(json_encode($contest));
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
        $Contest = Contest::class;
        $contest = $Contest::find($id);

        // Checks is user is an administrator
        $this->checkIsAdmin($contest->gym_id);

        $contest->delete();

        return response()->json(json_encode($contest));
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

    private function concatDate($date, $hour, $minute)
    {
        $dateYMD = Carbon::createFromFormat('Y-m-d', $date);
        return Carbon::create($dateYMD->year, $dateYMD->month, $dateYMD->day, $hour, $minute);
    }
}
