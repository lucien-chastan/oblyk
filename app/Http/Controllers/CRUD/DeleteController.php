<?php

namespace App\Http\Controllers\CRUD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteController extends Controller
{

    //AFFICHE LA POPUP POUR SUPPRIMER UN ÉLÉMENT
    function deleteModal(Request $request){
        $data = [
            'dataModal' => [
                'id' => $request->input('id'),
                'route' => $request->input('route')
            ]
        ];
        return view('modal.delete', $data);
    }
}
