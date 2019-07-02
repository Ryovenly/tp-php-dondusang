<?php

namespace Ynov;

class Application
{
    public function adress()
    {
        if ($_GET)
        {
        $adress = urlencode($_GET['addresse']);
        $adressName = new Geolocation\Adresse($adress);
        $donAdress = new Geolocation\Adresse('http://api.openeventdatabase.org/event/?what=health.blood.collect&when=today&limit=500');
        $donAdressArray = $donAdress->getDonAdress('http://api.openeventdatabase.org/event/?what=health.blood.collect&when=today&limit=500');
        $adressArray = $adressName->getAdress($adress);
        $adressX = $adressName->getX($adressArray);
        $adressY = $adressName->getY($adressArray);
        $donAdressY = $donAdress->getAllDonY($donAdressArray);
        $donAdressX = $donAdress->getAllDonX($donAdressArray);
        $counter = sizeof($donAdressX);
        for($i = 0; $i < $counter; $i++){
            $calculatedDistance = new Geolocation\Calcul($adressX,$adressY,$donAdressX[$i],$donAdressY[$i]);
            $calculusArray[] = $calculatedDistance->calculatedDistance($adressY,$adressX,$donAdressY[$i],$donAdressX[$i]);
        }
        $closeAdress = new Geolocation\AdresseDon($calculusArray);
        $closeAdress->locationAvailable($calculusArray);
        }
    }
}
