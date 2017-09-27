<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function homePage(){
        return view('pages.admin.home');
    }

    public function uploadSaePage(){
        return view('pages.admin.sae.upload');
    }

}
