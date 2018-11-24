<?php

namespace App\Lib;

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
    public static function tooltip($tooltip, $position = 'top' , $delay = 50)
    {
        return 'data-position="' . $position . '" data-delay="' . $delay . '" data-tooltip="' . $tooltip . '"';
    }

    /**
     * @param string $route - route de la popup
     * @param $datas
     * @return string
     */
    public static function modal($route, $datas)
    {
        $arrayData = [];
        foreach ($datas as $key => $data) $arrayData[] = "'" . $key . "':'" . $datas[$key] . "'";
        $compilData = '{' . implode(',',$arrayData) . '}';

        return 'data-route="' . $route . '" data-modal="' . $compilData . '" data-target="modal"';
    }


    /**
     * @param $str
     * @param string $charset
     * @return string - chaîne sans accent
     */
    public static function withoutAccent($str, $charset='utf-8')
    {
        $str = htmlentities($str, ENT_NOQUOTES, $charset);

        $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
        $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

        return $str;
    }

    public static function pre($array)
    {
        return '<pre>' . json_encode($array) . '</pre>';
    }

    public static function hexToRgb($hex, $alpha = false) : array
    {
        $hex = str_replace('#', '', $hex);
        $length = strlen($hex);
        $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
        $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
        $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
        if ($alpha) {
            $rgb['a'] = $alpha;
        }
        return $rgb;
    }
}