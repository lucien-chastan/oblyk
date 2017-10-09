<?php

namespace App\Http\Controllers\CRUD;

use App\Crag;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Exception;



class ExceptionController extends Controller
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
            'exception_type' => 'required',
            'description' => 'required',
            'crag_id' => 'required|numeric'
        ]);

        //enregistrement des données
        $exception = new Exception();
        $exception->crag_id = $request->input('crag_id');
        $exception->user_id = Auth::id();
        $exception->exception_type = $request->input('exception_type');
        $exception->description = $request->input('description');
        $exception->save();

        $crag = Crag::find($exception->crag_id);

        return redirect()->route('cragPage', ['crag_id' => $crag->id, 'crag_label' => str_slug($crag->label)]);
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
            'exception_type' => 'required',
            'description' => 'required',
            'crag_id' => 'required|numeric'
        ]);

        //enregistrement des données
        $exception = Exception::find($request->input('id'));
        $exception->crag_id = $request->input('crag_id');
        $exception->exception_type = $request->input('exception_type');
        $exception->description = $request->input('description');
        $exception->save();

        return response()->json(json_encode($exception));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $exception = Exception::find($id);
        $exception->delete();

    }
}
