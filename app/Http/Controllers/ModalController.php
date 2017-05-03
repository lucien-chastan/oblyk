<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModalController extends Controller
{

    function descriptionModal(Request $request){

        $data = [
            'request'=> $request->input('crag_id')
        ];

        return view('modal.description', $data);
    }
}