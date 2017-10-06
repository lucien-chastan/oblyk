<?php

namespace App\Http\Controllers\CRUD;

use App\Crag;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShareCragController extends Controller
{

    //AFFICHE LA POPUP POUR AJOUTER / MODIFIER UN lien
    function shareModal(Request $request){

        //construction de la définition (vide ou avec des infos)
        $crag = Crag::where('id', $request->input('id'))->first();

        $data = [
            'dataModal' => [
                'crag' => $crag,
                'title' => $request->input('title')
            ]
        ];

        return view('modal.shareCragModal', $data);
    }

}
