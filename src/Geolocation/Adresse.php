<?php

namespace Ynov\Geolocation;

class Adresse
{
    private $adress;

    public function __construct(string $adress)
    {
        $this->adress = $adress;
    }

    public function getAdress(string $adress)
    {
        return json_decode(file_get_contents('https://api-adresse.data.gouv.fr/search/?q='.$adress, TRUE),true);
    }
    public function getDonAdress(string $adress)
    {
        return json_decode(file_get_contents($adress),true);
    }

    # Coordonnée adresse

    public function getX(array $adressArray)
    {
        return $adressArray["features"][0]["geometry"]["coordinates"][0];
    }
    public function getY(array $adressArray)
    {
        return $adressArray["features"][0]["geometry"]["coordinates"][1];
    }

    # Coordonnées Don de sang

    public function getAllDonY(array $adressArray) : array
    {
        foreach ($adressArray["features"] as $adressArrays){
            $latitudeData[] = $adressArrays["geometry"]["coordinates"][1];
        }
        return $latitudeData;
    }
    public function getAllDonX(array $adressArray) : array
    {
        foreach ($adressArray["features"] as $adressArrays){
            $longitudeData[] = $adressArrays["geometry"]["coordinates"][0];
        }
        return $longitudeData;
    }


}