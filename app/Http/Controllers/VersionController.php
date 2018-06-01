<?php

namespace App\Http\Controllers;

use App\Version;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function versionModal(Request $request){

        $typeModel = 'App\\' . $request->input('model');
        $idModel = $request->input('id');

        $versions = Version::where([
            ['versionnable_id','=',$idModel],
            ['versionnable_type','=',$typeModel]
        ])->orderBy('created_at','desc')->get();

        foreach ($versions as &$version) {
            $version['changes'] = json_decode($version['changes']);
        }

        return view('modal.version', [
            'versions' => $versions,
        ]);
    }
}
