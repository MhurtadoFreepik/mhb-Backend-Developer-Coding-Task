<?php
declare(strict_types=1);

namespace App\Application\Actions\Country;

use App\Domain\Country\Country;
use Psr\Http\Message\ResponseInterface as Response;

class ViewCountryAction extends CountryAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $code = $this->resolveArg('country-code');
        $countryObject = $this->countryRepository->fetchCountry($code);
        $rivalCode = "no";
        $rival = $this->countryRepository->fetchCountry($rivalCode);
        $strRes = $this->calculate($countryObject, $rival);
        return $this->respondWithData($strRes);
    }

    private function calculate(Country $country, Country $rival) : string
    {
        $vocals = array('a','e','i','o','u');
        $region = "europe";
        $population = [8e7, 5e7];
        $criteria = [];
        
        $criteria[] = in_array(substr($country->getCode(), 0, 1), $vocals);
        $criteria[] = $country->getRegion() === $region; //region
        $criteria[] = $country->getRegion() === "Asia" ?
            $country->getPopulation() >= $population[0]:
            $country->getPopulation() >= $population[1];
        $criteria[] = $country->getPopulation() > $rival->getPopulation();

        $result = true;
        foreach ($criteria as $c) {
            $result = $result && $c;
        };

        $objectRes = array(
            'result' => $result,
            'criteria' => array(
                'code' => $criteria[0],
                'region' => $criteria[1],
                'population' => $criteria[2],
                'rival' => $criteria[3]
            )
        );
        $jsonRes = json_encode($objectRes);
        return $jsonRes;
    }
}
