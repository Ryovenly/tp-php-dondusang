<?php

namespace Ynov\Geolocation;

class Calcul
{
    private $x;
    private $y;
    private $donx;
    private $dony;

    public function __construct(float $x, float $y, float $donx, float $dony)
    {
        $this->x = $x;
        $this->y = $y;
        $this->donx = $donx;
        $this->dony = $dony;
    }


    # Formule Calcul de la distance entre 2 coordonnées GPS : https://numa-bord.com/miniblog/php-calcul-de-distance-entre-2-coordonnees-gps-latitude-longitude/

    public function calculatedDistance($lat1, $lng1, $lat2, $lng2, $unit = 'k')
    {
        $earth_radius = 6378137;   // Terre = sphère de 6378km de rayon
        $rlo1 = deg2rad($lng1);
        $rla1 = deg2rad($lat1);
        $rlo2 = deg2rad($lng2);
        $rla2 = deg2rad($lat2);
        $dlo = ($rlo2 - $rlo1) / 2;
        $dla = ($rla2 - $rla1) / 2;
        $a = (sin($dla) * sin($dla)) + cos($rla1) * cos($rla2) * (sin($dlo) * sin($dlo));
        $d = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $meter = ($earth_radius * $d);
        if ($unit == 'k') {
            return $meter / 1000;
        }
        return $meter;
    }
}
