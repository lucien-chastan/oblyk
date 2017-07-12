<?php

namespace App\Http\Controllers\CRUD;

use App\Follow;
use App\Route;
use App\TickList;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TickListController extends Controller
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

        //enregistrement des données
        $tickList = new TickList();
        $tickList->user_id = Auth::id();
        $tickList->route_id = $request->input('route_id');
        $tickList->save();

        return response()->json(json_encode($tickList));

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
        $tickList = TickList::where('id', $id)->first();

        if($tickList->user_id == Auth::id()){
            $tickList->delete();
        }
    }

    function deleteTickList(Request $request){
        $userTickList = TickList::where(
            [
                ['user_id', '=', Auth::id()],
                ['route_id', '=', $request->input('route_id')],
            ]
        )->first();
        $userTickList->delete();
    }

    function addTickList(Request $request){

        $route = Route::where('id',$request->input('route_id'))->first();

        $userTickList = new TickList();
        $userTickList->route_id = $route->id;
        $userTickList->user_id = Auth::id();
        $userTickList->save();

        return response()->json($route);
    }
}
