<?php

namespace App\Http\Controllers;

use App\Topo;
use Illuminate\Http\Request;

class TopoController extends Controller
{
    function topoPage($topo_id, $topo_title){

        $topo = Topo::where('id', $topo_id)
            ->with('descriptions')
            ->withCount('links')
            ->withCount('crags')
            ->withCount('sales')
            ->first();

        $data = [
            'topo' => $topo,
            'meta_title' => $topo['label'],
            'meta_description' => 'description de ' . $topo['label']
        ];

        return view('pages.topo.topo', $data);
    }
}
