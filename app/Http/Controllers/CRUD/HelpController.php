<?php

namespace App\Http\Controllers\CRUD;

use App\Help;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;



class HelpController extends Controller
{

    //Index tous les aides dans elastic search
    public function IndexElasticHelp(){
        Help::addAllToIndex();
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
            'label' => 'required|max:255',
            'category' => 'required|max:255',
            'contents' => 'required',
        ]);

        //enregistrement des données
        $help = new Help();
        $help->label = $request->input('label');
        $help->category = $request->input('category');
        $help->contents = $request->input('contents');
        $help->save();

        //Ajout à elastic search
        $help->addToIndex();

        return redirect()->route('help');
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
            'label' => 'required|max:255',
            'category' => 'required|max:255',
            'contents' => 'required',
        ]);

        //enregistrement des données
        $help = Help::find($request->input('id'));
        $help->label = $request->input('label');
        $help->category = $request->input('category');
        $help->contents = $request->input('contents');
        $help->save();

        //Ajout à elastic search
        $help->addToIndex();

        return response()->json(json_encode($help));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $help = Help::find($id);
        $help->removeFromIndex();
        $help->delete();

    }
}
