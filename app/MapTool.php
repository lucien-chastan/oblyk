<?php

namespace App;

class MapTool
{
    /**
     * Get distance in kilometers between tow GPS point
     *
     * @param $lat1 float
     * @param $lng1 float
     * @param $lat2 float
     * @param $lng2 float
     * @return float
     */
    static function getDistance(float $lat1, float $lng1, float $lat2, float $lng2) : float
    {
        $earth_radius = 6378137;
        $rlo1 = deg2rad($lng1);
        $rla1 = deg2rad($lat1);
        $rlo2 = deg2rad($lng2);
        $rla2 = deg2rad($lat2);
        $dlo = ($rlo2 - $rlo1) / 2;
        $dla = ($rla2 - $rla1) / 2;
        $a = (sin($dla) * sin($dla)) + cos($rla1) * cos($rla2) * (sin($dlo) * sin($dlo));
        $d = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return (float)($earth_radius * $d / 1000);
    }
}