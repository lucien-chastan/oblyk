<?php

namespace App\Http\Controllers;

use App\Help;
use Illuminate\Http\Request;

class ToolPagesController extends Controller
{
    //Page de cotation
    public function gradePage(){
        return view('pages.tools.grade');
    }

}
