<?php 

namespace Ynov\Geolocation;

class AdresseDon
{
    public function locationAvailable(array $calculusArray)
    {
        asort($calculusArray);
        $sortedArray = array_values($calculusArray);
        $tableau = new Tableau();
        $donAdress = new Adresse('http://api.openeventdatabase.org/event/?what=health.blood.collect&when=today&limit=500');
        $donAdressArray = $donAdress->getDonAdress('http://api.openeventdatabase.org/event/?what=health.blood.collect&when=today&limit=500');
        $AddressKey = $tableau->GetClosestAddressKey($calculusArray);
        echo"
        <div class='container'>
        <h2>Nous avons trouvé 2 points de don du sang.</h2>
        <hr />
        <div class='row'>
            <div class='col-md-4'>
                <div class='card'>
                <div class='card-body'>
                    <h5 class='card-title'>".$donAdressArray['features'][$AddressKey[0]]['properties']['name']."</h5>
                    <p class='card-text'>à ".round($sortedArray[0])." km</p>
                </div>
                </div>
            </div>
            <div class='col-md-4'>
                <div class='card'>
                <div class='card-body'>
                    <h5 class='card-title'>".$donAdressArray['features'][$AddressKey[1]]['properties']['name']."</h5>
                    <p class='card-text'>à ".round($sortedArray[1])." km</p>
                </div>
                </div>
            </div>
        </div>
        </div>";
    }
}
