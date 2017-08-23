<?php

namespace App\Http\Controllers\CRUD;

use App\Route;
use App\Tag;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN PARKING
    function tagModal(Request $request){

        $route = Route::where('id',$request->input('route_id'))->with('tags')->first();
        $tags = [];
        foreach ($route->tags as $tag) $tags[] = $tag->tag_id;

        $callback = $request->input('callback');
        $callback = isset($callback) ? $request->input('callback') : 'refresh';

        $data = [
            'dataModal' => [
                'route_id' => $route->id,
                'routeTags' => $tags,
                'title' => $request->input('title'),
                'method' => $request->input('method'),
                'route' => '/tags',
                'callback' => $callback,
            ]
        ];

        return view('modal.tag', $data);
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
            'route_id' => 'required',
            'tagsList' => 'required',
        ]);

        $route = Route::where('id',$request->input('route_id'))->with('tags')->first();

        $tags = explode(';', $request->input('tagsList'));

        // passe UNE : on supprime les anciens qui tag en trop
        $clearTags = [];
        foreach ($route->tags as $oldTag) {
            if(!in_array($oldTag->tag_id, $tags)) {
                $oldTag->delete();
            }else{
                $clearTags[] = $oldTag->tag_id;
            }
        }

        //passe DEUX : on ajoute les nouveau tag
        foreach ($tags as $newTag){
            if(!in_array($newTag, $clearTags)) {
                $tag = new Tag();
                $tag->route_id = $route->id;
                $tag->tag_id = $newTag;
                $tag->user_id = Auth::id();
                $tag->save();
            }
        }
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
