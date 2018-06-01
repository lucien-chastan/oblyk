<?php

namespace App\Http\Controllers\CRUD;

use App\Newsletter;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class NewsletterController extends Controller
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
            'ref' => 'required|max:10',
            'title' => 'required|max:255',
            'abstract' => 'required',
            'content' => 'required',
        ]);

        //enregistrement des données
        $newsletter = new Newsletter();
        $newsletter->ref = $request->input('ref');
        $newsletter->title = $request->input('title');
        $newsletter->abstract = $request->input('abstract');
        $newsletter->content = $request->input('content');
        $newsletter->save();

        return redirect()->route('newsletter', ['ref'=>$newsletter->ref]);

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
            'ref' => 'required',
            'id' => 'required|max:10',
            'title' => 'required|max:255',
            'abstract' => 'required',
            'content' => 'required',
        ]);

        //enregistrement des données
        $newsletter = Newsletter::where('ref', $request->input('ref'))->first();
        $newsletter->ref = $request->input('ref');
        $newsletter->title = $request->input('title');
        $newsletter->abstract = $request->input('abstract');
        $newsletter->content = $request->input('content');
        $newsletter->save();

        return response()->json(json_encode($newsletter));
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
