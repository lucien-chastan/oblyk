<?php

namespace App\Lib;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class InputTemplates extends ServiceProvider{

    public function __construct(){
        //
    }

    public static function test(){
        return '<p>ok</p>';
    }
}
