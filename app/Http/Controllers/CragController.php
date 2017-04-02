<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CragController extends Controller
{
    function cragPage($crag_id, $crag_label){

        $crag = Crag::findOrFail($crag_id);

        $data = [
            'crag' => $crag,
            'meta_title' => $crag['label'],
            'meta_description' => 'description de ' . $crag['label']
        ];

        return view('pages.crag.crag', $data);
    }
}
