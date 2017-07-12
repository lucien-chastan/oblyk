<?php

namespace App\Http\Controllers\CRUD;

use App\User;
use App\UserSettings;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function saveSettings(Request $request){

        $settings = UserSettings::where('user_id', Auth::id())->first();

        $settings->dash_welcome = $request->input('dash_welcome');
        $settings->dash_comments = $request->input('dash_comments');
        $settings->dash_crags = $request->input('dash_crags');
        $settings->dash_friend_cross = $request->input('dash_friend_cross');
        $settings->dash_forum = $request->input('dash_forum');
        $settings->dash_list_crag_sae = $request->input('dash_list_crag_sae');
        $settings->dash_my_cross = $request->input('dash_my_cross');
        $settings->dash_oblyk_news = $request->input('dash_oblyk_news');
        $settings->dash_partenaire = $request->input('dash_partenaire');
        $settings->dash_photos = $request->input('dash_photos');
        $settings->dash_routes = $request->input('dash_routes');
        $settings->dash_sae = $request->input('dash_sae');
        $settings->dash_topos = $request->input('dash_topos');
        $settings->dash_users = $request->input('dash_users');
        $settings->dash_videos = $request->input('dash_videos');
        $settings->save();

        return response()->json($settings);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
