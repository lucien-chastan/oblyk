<?php

namespace App\Http\Controllers;

use App\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LexiqueController extends Controller
{

    public function lexiquePage(){

        $alphaTab = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0-9', ];

        $data = [
            'meta_title' => 'Le lexique de l\'escalade',
            'alphas' => $alphaTab,
            'words' => Word::where('id','>',0)->with('user')->get(),
            ];
        return view('pages.lexique.lexique', $data);
    }

}
