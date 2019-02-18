<?php

namespace App\Http\Controllers\CRUD;

use App\Cross;
use App\CrossSection;
use App\CrossUser;
use App\Description;
use App\Follow;
use App\Route;
use App\TickList;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CrossController extends Controller
{
    // Display modal for update or create cross
    function crossModal(Request $request)
    {
        $id_cross = $request->input('cross_id');
        $route_id = $request->input('route_id');
        $line = Route::where('id', $route_id)->with('routeSections')->first();
        $crossPitchs = [];
        $crossNote = 0;
        $crossDescription = '';
        $crossPrivate = 0;
        $release_at = Carbon::now()->format('Y-m-d');

        // Create or update
        if (isset($id_cross)) {
            $cross = Cross::where('id', $id_cross)->with('crossSections')->first();
            $release_at = $cross->release_at->format('Y-m-d');
            foreach ($cross->crossSections as $section) $crossPitchs[] = $section->route_section_id;

            // Get associated description
            $description = Description::where('cross_id', $cross->id)->first();
            if (isset($description)) {
                $crossNote = $description->note;
                $crossDescription = $description->description;
                $crossPrivate = $description->private;
            }

        } else {
            $cross = new Cross();
            $cross->attempt = 1;
            foreach ($line->routeSections as $section) $crossPitchs[] = $section->id;
        }

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        // Output path
        $outputRoute = ($request->input('method') == 'POST') ? '/crosses' : '/crosses/' . $id_cross;

        $showMode = $line->climb_id == 3 || $line->climb_id == 4 || $line->climb_id == 5 || $line->climb_id == 6 ? '' : 'display:none';
        $showPitchs = count($line->routeSections) > 1 ? '' : 'display:none';

        $data = [
            'dataModal' => [
                'route_id' => $route_id,
                'status_id' => $cross->status_id,
                'mode_id' => $cross->mode_id,
                'hardness_id' => $cross->hardness_id,
                'environment' => $cross->environment,
                'attempt' => $cross->attempt,
                'release_at' => $release_at,
                'id' => $id_cross,
                'line' => $line,
                'showMode' => $showMode,
                'showPitchs' => $showPitchs,
                'crossPitchs' => $crossPitchs,
                'crossNote' => $crossNote,
                'crossDescription' => $crossDescription,
                'crossPrivate' => $crossPrivate,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback,
            ]
        ];

        return view('modal.cross', $data);
    }

    function crossUserModal(Request $request)
    {
        // Get friends
        $friends = Follow::where([['followed_type', 'App\\User'], ['followed_id', Auth::id()]])->with('user')->get();

        $id_cross = $request->input('cross_id');
        $cross = Cross::where('id', $id_cross)->with('crossUsers')->first();

        // Retrieves users already linked
        $crossFriends = [];
        foreach ($cross->crossUsers as $user) $crossFriends[] = $user->user_id;

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        $outputRoute = '/cross/users';

        $data = [
            'dataModal' => [
                'crossFriends' => $crossFriends,
                'friends' => $friends,
                'id' => $id_cross,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback
            ]
        ];

        return view('modal.crossUser', $data);
    }

    // Update linked users
    function crossUsers(Request $request)
    {
        $cross = Cross::where('id', $request->input('id'))->with('crossUsers')->first();

        if ($request->input('crossFriends') != '') {
            $crossFriends = explode(';', $request->input('crossFriends'));

            // Deletes friends who are no longer connected
            $clearFriends = [];
            foreach ($cross->crossUsers as $crossUser) {
                if (!in_array($crossUser->user_id, $crossFriends)) {
                    $crossUser->delete();
                } else {
                    $clearFriends[] = $crossUser->user_id;
                }
            }

            // Add new friends
            foreach ($crossFriends as $friend) {
                if (!in_array($friend, $clearFriends)) {
                    $crossUser = new CrossUser();
                    $crossUser->cross_id = $cross->id;
                    $crossUser->user_id = $friend;
                    $crossUser->save();
                }
            }
        } else {
            // Delete all users if array is empty
            foreach ($cross->crossUsers as $crossUser) {
                $crossUser->delete();
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valid form
        $this->validate($request, [
            'release_at' => 'required|date_format:Y-m-d',
            'attempt' => 'min:0',
        ]);

        $cross = new Cross();
        $cross->route_id = $request->input('route_id');
        $cross->status_id = $request->input('status_id');
        $cross->mode_id = $request->input('mode_id');
        $cross->hardness_id = $request->input('hardness_id');
        $cross->environment = $request->input('environment');
        $cross->attempt = $request->input('attempt');
        $cross->release_at = $request->input('release_at');
        $cross->user_id = Auth::id();
        $cross->save();


        // If has description
        if ($request->input('note') != 0 || $request->input('description') != '') {
            $description = new Description();
            $description->descriptive_id = $cross->route_id;
            $description->descriptive_type = 'App\Route';
            $description->description = $request->input('description');
            $description->user_id = Auth::id();
            $description->cross_id = $cross->id;
            $description->note = $request->input('note');
            $description->private = $request->input('private');
            $description->save();
        }

        // Save section
        $crossTab = explode(';', $request->input('crossPitchs'));
        foreach ($crossTab as $routeSectionId) {
            $crossSection = new CrossSection();
            $crossSection->route_section_id = $routeSectionId;
            $crossSection->cross_id = $cross->id;
            $crossSection->save();
        }

        // save min and max grade in cross
        $cross->min_grade_val = $cross->minGrade();
        $cross->max_grade_val = $cross->maxGrade();
        $cross->save();

        // Delete route on tick list if exist
        $ticks = TickList::where([['route_id', $cross->route_id], ['user_id', Auth::id()]])->get();
        foreach ($ticks as $tick) $tick->delete();

        return response()->json(json_encode($cross));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Valid form
        $this->validate($request, [
            'release_at' => 'required|date_format:Y-m-d',
            'attempt' => 'min:0',
        ]);

        $cross = Cross::where('id', $request->input('id'))->with('crossSections')->first();
        if ($cross->user_id == Auth::id()) {
            $cross->status_id = $request->input('status_id');
            $cross->release_at = $request->input('release_at');
            $cross->status_id = $request->input('status_id');
            $cross->mode_id = $request->input('mode_id');
            $cross->hardness_id = $request->input('hardness_id');
            $cross->attempt = $request->input('attempt');
            $cross->save();

            // Get associated description
            $description = Description::where('cross_id', $cross->id)->first();
            if (isset($description)) {
                $description->note = $request->input('note');
                $description->description = $request->input('description');
                $description->private = $request->input('private');
                $description->save();
            } else {
                if ($request->input('note') != 0 || $request->input('description') != '') {
                    $description = new Description();
                    $description->descriptive_id = $cross->route_id;
                    $description->descriptive_type = 'App\Route';
                    $description->description = $request->input('description');
                    $description->user_id = Auth::id();
                    $description->cross_id = $cross->id;
                    $description->note = $request->input('note');
                    $description->private = $request->input('private');
                    $description->save();
                }
            }

            $pitchs = explode(';', $request->input('crossPitchs'));

            $clearSections = [];
            foreach ($cross->crossSections as $crossSection) {
                if (!in_array($crossSection->route_section_id, $pitchs)) {
                    $crossSection->delete();
                } else {
                    $clearSections[] = $crossSection->route_section_id;
                }
            }

            foreach ($pitchs as $pitch) {
                if (!in_array($pitch, $clearSections)) {
                    $crossSection = new CrossSection();
                    $crossSection->cross_id = $cross->id;
                    $crossSection->route_section_id = $pitch;
                    $crossSection->save();
                }
            }
        }

        // save min and max grade in cross
        $cross->min_grade_val = $cross->minGrade();
        $cross->max_grade_val = $cross->maxGrade();
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
        $cross = Cross::where('id', $id)->first();
        $oldCross = $cross;
        if ($cross->user_id == Auth::id()) {
            $cross->delete();
        }
        return response()->json($oldCross);
    }
}
