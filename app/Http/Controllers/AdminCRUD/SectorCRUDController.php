<?php

namespace App\Http\Controllers\AdminCRUD;

use App\Sector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SectorCRUDController extends Controller
{

    public function deleteSector($sector_id){

        Sector::find($sector_id)->delete();

        return back();

    }

}
