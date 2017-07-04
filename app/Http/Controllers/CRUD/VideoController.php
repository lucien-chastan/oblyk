<?php

namespace App\Http\Controllers\CRUD;

use App\Video;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function videoModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $id_video = $request->input('video_id');
        $video = isset($id_video) ? Video::where('id', $id_video)->first() : new Video();

        //définition du chemin de sauvgarde
        $outputRoute = ($request->input('method') == 'POST')? '/videos' : '/videos/' . $id_video;

        $data = [
            'dataModal' => [
                'viewable_id' => $request->input('viewable_id'),
                'viewable_type' => "App\\" . $request->input('viewable_type'),
                'iframe' => $video->iframe,
                'description' => $video->description,
                'id' => $id_video,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => $outputRoute
            ]
        ];

        return view('modal.video', $data);
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
        //validation du formulaire
        $this->validate($request, [
            'viewable_id' => 'required|Integer',
            'viewable_type' => 'required|String',
            'iframe' => 'required'
        ]);

        //enregistrement des données
        $video = new Video();
        $video->viewable_id = $request->input('viewable_id');
        $video->viewable_type = $request->input('viewable_type');
        $video->description = $request->input('description');
//        $video->iframe = $request->input('iframe');
        $video->iframe = Video::convertUrl($request->input('iframe'));
        $video->user_id = Auth::id();
        $video->save();

        return response()->json(json_encode($video));

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
        //validation du formulaire
        $this->validate($request, [
            'viewable_id' => 'required|Integer',
            'viewable_type' => 'required|String',
            'iframe' => 'required|max:255',
        ]);

        //enregistrement des données
        $video = Video::where('id', $request->input('id'))->first();
        if($video->user_id == Auth::id()){
            $video->description = $request->input('description');
            $video->iframe = $request->input('iframe');
            $video->save();
        }

        return response()->json(json_encode($video));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::where('id', $id)->first();

        if($video->user_id == Auth::id()){
            $video->delete();
        }
    }
}
