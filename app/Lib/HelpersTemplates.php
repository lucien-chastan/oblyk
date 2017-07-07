<?php

namespace App\Lib;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class HelpersTemplates extends ServiceProvider
{

    public function __construct()
    {
        //
    }

    /**
     * @param string $tooltip - text à afficher dans le tooltip
     * @param string $position - position du tool tip [top, bottom, let, right] par défaut top
     * @param int $delay - temps d'ouverture du tooltip
     * @return string
     */
    public static function tooltip($tooltip, $position = 'top' , $delay = 50){
        return 'data-position="' . $position . '" data-delay="' . $delay . '" data-tooltip="' . $tooltip . '"';
    }

    /**
     * @param string $route - route de la popup
     * @param array $data - tableau des données à passer
     * @return string
     */
    public static function modal($route, $datas){

        $arrayData = [];
        foreach ($datas as $key => $data) $arrayData[] = "'" . $key . "':'" . $datas[$key] . "'";
        $compilData = '{' . implode(',',$arrayData) . '}';

        return 'data-route="' . $route . '" data-modal="' . $compilData . '" data-target="modal"';
    }


    /**
     * @param $string - chaîne à convertire
     * @return string - chaîne sans accent
     */
    public static function withoutAccent($str, $charset='utf-8'){
        $str = htmlentities($str, ENT_NOQUOTES, $charset);

        $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
        $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

        return $str;
    }
}