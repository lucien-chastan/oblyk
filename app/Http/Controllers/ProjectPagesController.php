<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectPagesController extends Controller
{
    //CONTROLLER DES PETITES PAGES LIÉES AU PROJET, TELLE QUE "QUI SOMME NOUS", "LE PORJET", "MENTIONS LÉGALE", ETC.
    public function projectPage(){
        $data = ['meta_title' => 'Le Projet',];
        return view('pages.project.project', $data);
    }

    public function whoPage(){
        $data = ['meta_title' => 'Qui sommes-nous ?',];
        return view('pages.project.who', $data);
    }

    public function contactPage(){
        $data = ['meta_title' => 'Contact',];
        return view('pages.project.contact', $data);
    }

    public function aboutPage(){
        $data = ['meta_title' => 'À propos d\'oblyk',];
        return view('pages.project.about', $data);
    }

    public function helpPage(){
        $data = ['meta_title' => 'Aide',];
        return view('pages.project.help', $data);
    }

    public function supportUsPage(){
        $data = ['meta_title' => 'Nous soutenire',];
        return view('pages.project.supportUs', $data);
    }

    public function developerPage(){
        $data = ['meta_title' => 'Développer et API',];
        return view('pages.project.developer', $data);
    }

    public function termsOfUsePage(){
        $data = ['meta_title' => 'Conditions d\'utilisation',];
        return view('pages.project.termsOfUse', $data);
    }
}
