<?php

namespace App\Http\Controllers;

use App\Crag;
use App\Rock_;
use Illuminate\Http\Request;

class CragController extends Controller
{
    function cragPage($crag_id, $crag_title){

        $crag = Crag::where('id', $crag_id)
            ->with('rocks')
            ->with('orientations')
            ->with('seasons')
            ->with('descriptions')
            ->first();

        $data = [
            'crag' => $crag,
            'meta_title' => $crag['label'],
            'meta_description' => 'description de ' . $crag['label']
        ];

        return view('pages.crag.crag', $data);
    }
}
