<?php

namespace App\Http\Controllers\CRUD;

use App\Link;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
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
            'linkable_id' => 'required|Integer',
            'linkable_type' => 'required|String',
            'label' => 'required|max:255',
            'link' => 'required|max:255'
        ]);

        //enregistrement des données
        $link = new Link();
        $link->linkable_id = $request->input('linkable_id');
        $link->linkable_type = $request->input('linkable_type');
        $link->description = $request->input('description');
        $link->label = $request->input('label');
        $link->link = $request->input('link');
        $link->user_id = Auth::id();
        $link->save();

        return response()->json(json_encode($link));

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
            'linkable_id' => 'required|Integer',
            'linkable_type' => 'required|String',
            'label' => 'required|max:255',
            'link' => 'required|max:255'
        ]);

        //enregistrement des données
        $link = Link::where('id', $request->input('id'))->first();
        if($link->user_id == Auth::id()){
            $link->description = $request->input('description');
            $link->label = $request->input('label');
            $link->link = $request->input('link');
            $link->save();
        }

        return response()->json(json_encode($link));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $link = Link::where('id', $id)->first();

        if($link->user_id == Auth::id()){
            $link->delete();
        }
    }
}
