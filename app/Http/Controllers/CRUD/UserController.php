<?php

namespace App\Http\Controllers\CRUD;

use App\User;
use App\UserSettings;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    //ENREGISTRE LES PARAMÈTRES DU DASH
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

    //ENREGISTRE LES PARAMÈTRES DE CONNEXION
    function saveMailPassword(Request $request){

        $user = User::where('id',Auth::id())->first();

        if($request->input('change_mpd')){

            $this->validate($request, [
                'password_old'=>"required",
                'password_new'=>"required|same:password_confirm|min:8|max:255",
                'password_confirm'=>"required|same:password_new|min:8|max:255",
                'email'=>"required|unique:users,email,$user->id|max:255|email",
            ]);

            $currentPassword = $user->password;
            $newPassword = $request->input('password_new');
            $checkPassword = $request->input('password_old');

            if(Hash::check($checkPassword, $currentPassword)) {
                $user->password = Hash::make($newPassword);
                $user->email = $request->input('email');
                $user->save();
            } else {
                return response()->json(['password_old' => ['Erreur dans l\'ancien mot de passe']], 422);
            }

        }else{

            $this->validate($request, [
                'email'=>"required|unique:users,email,$user->id|max:255|email",
            ]);

            $user->email = $request->input('email');
            $user->save();
        }

        return response()->json($user);
    }


    //ENREGISTRE LES PARAMÈTRES DE LA MESSAGERIE
    function saveUserMessagerieSettings(Request $request){

        $settings = UserSettings::where('user_id', Auth::id())->first();

        $settings->mail_new_conversation = $request->input('mail_new_conversation');
        $settings->mail_new_message = $request->input('mail_new_message');
        $settings->sound_alert = $request->input('sound_alert');
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

        $user = User::where('id', Auth::id())->first();

        $this->validate($request, [
            'name'=>"required|unique:users,name,$user->id|max:255"
        ]);

        $user->name = $request->input('name');
        $user->localisation = $request->input('localisation');
        $user->birth = $request->input('birth');
        $user->sex = $request->input('sex');
        $user->description = $request->input('description');
        $user->save();

        return response()->json(json_encode($user));
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
