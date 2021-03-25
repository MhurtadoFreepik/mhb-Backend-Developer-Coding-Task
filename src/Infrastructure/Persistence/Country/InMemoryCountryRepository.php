<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Country;

use App\Domain\Country\Country;
use App\Domain\Country\CountryNotFoundException;
use App\Domain\Country\CountryRepository;

class InMemoryCountryRepository implements CountryRepository
{
    /**
     * {@inheritdoc}
    */
    public function fetchCountry(string $code) : Country
    {
        $url = "https://restcountries-v1.p.rapidapi.com/alpha/?codes=" . $code;
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "x-rapidapi-host: restcountries-v1.p.rapidapi.com",
                    "x-rapidapi-key: 2dfaff8260msh71e2602d2fdd8e0p14307djsn8de366b0a61c"
                ],
            ]
        );
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $jsonRes = json_decode($response);
        $country = $jsonRes[0];
        
        if(!is_object($country)){
            throw new CountryNotFoundException();
        }

        $code = strtolower($country->alpha2Code);
        $region = strtolower($country->region);
        $population = $country->population;
        $countryObject = new Country($code, $region, $population);
        
        return $countryObject;
    }
}
