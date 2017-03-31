<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectPagesController extends Controller
{
    //CONTROLLER DES PETITES PAGES LIÉES AU PROJET, TELLE QUE "QUI SOMME NOUS", "LE PORJET", "MENTIONS LÉGALE", ETC.
    public function projectPage(){return view('pages.project.project');}
    public function whoPage(){return view('pages.project.who');}
    public function contactPage(){return view('pages.project.contact');}
    public function aboutPage(){return view('pages.project.about');}
    public function helpPage(){return view('pages.project.help');}
    public function supportUsPage(){return view('pages.project.supportUs');}
    public function developerPage(){return view('pages.project.developer');}
    public function termsOfUsePage(){return view('pages.project.termsOfUse');}
}
