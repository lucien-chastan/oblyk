<?php

namespace App\Http\Controllers\CRUD;

use App\Follow;
use App\UserSocialNetwork;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SocialNetworkController extends Controller
{


    function socialNetworkModal(Request $request){
        //construction de la définition (vide ou avec des infos)
        $id_social = $request->input('social_id');
        $social = isset($id_social) ? UserSocialNetwork::where('id', $id_social)->first() : new UserSocialNetwork();

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/socialNetworks' : '/socialNetworks/' . $id_social;

        $data = [
            'dataModal' => [
                'label' => $social->label,
                'url' => $social->url,
                'social_network_id' => $social->social_network_id,
                'id' => $id_social,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute,
                'callback' => $callback,
            ]
        ];

        return view('modal.socialNetwork', $data);
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

        $this->validate($request, [
            'url'=>"required|max:255",
        ]);

        //enregistrement des données
        $socialNetwork = new UserSocialNetwork();
        $socialNetwork->social_network_id = $request->input('social_network_id');
        $socialNetwork->label = $request->input('label');
        $socialNetwork->url = $request->input('url');
        $socialNetwork->user_id = Auth::id();
        $socialNetwork->save();

        return response()->json(json_encode($socialNetwork));

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
        $this->validate($request, [
            'url' => 'required|max:255'
        ]);

        $social = UserSocialNetwork::where('id', $request->input('id'))->first();
        if($social->user_id == Auth::id()){
            $social->social_network_id = $request->input('social_network_id');
            $social->label = $request->input('label');
            $social->url = $request->input('url');
            $social->save();
        }

        return response()->json($social);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $socialNetwork = UserSocialNetwork::where('id', $id)->first();

        if($socialNetwork->user_id == Auth::id()){
            $socialNetwork->delete();
        }
    }
}
