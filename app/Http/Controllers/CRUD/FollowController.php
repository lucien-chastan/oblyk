<?php

namespace App\Http\Controllers\CRUD;

use App\Follow;
use App\Notification;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{

    function userRelation(Request $request){

        $userAuth = User::where('id', Auth::id())->first();
        $userTarget = User::where('id', $request->input('user_id'))->first();

        $relation_status = $request->input('relation_status');

        //L'Auth demande en amis un autre User ou accept sa demande
        if($relation_status == 0 || $relation_status == 2) {
            $follow = new Follow();
            $follow->followed_id = $userTarget->id;
            $follow->followed_type = 'App\User';
            $follow->user_id = $userAuth->id;
            $follow->save();

            $userAuth->image = file_exists(storage_path('app/public/users/50/user-' . $userAuth->id . '.jpg')) ? '/storage/users/50/user-' . $userAuth->id . '.jpg' : '/img/icon-search-user.svg';

            if($relation_status == 0) {
                $notification = new Notification();
                $notification->type = 'demande_amis';
                $notification->user_id = $userTarget->id;
                $notification->data = Notification::jsonData(
                    'demande_amis',
                    [$userAuth->name],
                    $userAuth->image,
                    [$userAuth->url(), $userAuth->name],
                    [$userAuth->id]
                );
                $notification->save();
            }

            if($relation_status == 2) {
                $notification = new Notification();
                $notification->type = 'accepte_demande_amis';
                $notification->user_id = $userTarget->id;
                $notification->data = Notification::jsonData(
                    'accepte_demande_amis',
                    [$userAuth->name],
                    $userAuth->image,
                    [$userAuth->url(), $userAuth->name],
                    [$userAuth->id]
                );
                $notification->save();
            }

        }

        //L'Auth annule sa demande d'amis
        if($relation_status == 1) {
            $follow = Follow::where([['user_id',$userAuth->id],['followed_id',$userTarget->id],['followed_type','App\User']])->first();
            $follow->delete();
        }

        //L'Auth supprime son lien d'amitié
        if($relation_status == 3) {
            $followAuth = Follow::where([['user_id',$userAuth->id],['followed_id',$userTarget->id],['followed_type','App\User']])->first();
            $followAuth->delete();

            $followTarget = Follow::where([['user_id',$userTarget->id],['followed_id',$userAuth->id],['followed_type','App\User']])->first();
            $followTarget->delete();
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //see modal controller
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //enregistrement des données
        $follow = new Follow();
        $follow->followed_id = $request->input('followed_id');
        $follow->followed_type = $request->input('followed_type');
        $follow->user_id = Auth::id();
        $follow->save();

        return response()->json(json_encode($follow));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //see modal controller
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $follow = Follow::where('id', $id)->first();

        if($follow->user_id == Auth::id()){
            $follow->delete();
        }
    }

    function deleteFollow(Request $request){
        $userFollow = Follow::where(
            [
                ['user_id', '=', Auth::id()],
                ['followed_type', '=', $request->input('followed_type')],
                ['followed_id', '=', $request->input('followed_id')]
            ]
        )->first();
        $userFollow->delete();
    }
}
