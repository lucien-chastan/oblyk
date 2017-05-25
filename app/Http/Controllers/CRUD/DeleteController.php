<?php

namespace App\Http\Controllers\CRUD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{

    //AFFICHE LA POPUP POUR SUPPRIMER UN ÉLÉMENT
    function deleteModal(Request $request){

        $callback = $request->input('callback');
        $callback = isset($callback) ? $callback : 'refresh';

        $data = [
            'dataModal' => [
                'id' => $request->input('id'),
                'route' => $request->input('route'),
                'callback' => $callback
            ]
        ];
        return view('modal.delete', $data);
    }
}
