<?php

namespace App\Http\Controllers;

use App\Crag;
use Illuminate\Http\Request;

class IframeController extends Controller
{
    public function cragIframe($crag_id){

        $data = [
            'crag' => Crag::where('id', $crag_id)
                ->withCount('routes')
                ->with('gapGrade')
                ->first(),
        ];

        return view('iframes.crag', $data);
    }

}
