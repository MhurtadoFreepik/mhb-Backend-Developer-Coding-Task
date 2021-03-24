<?php
declare(strict_types=1);

namespace App\Application\Actions\Country;

use App\Domain\Country\Country;
use App\Application\Service\Country\CodeCriteriaService;
use App\Application\Service\Country\PopulationCriteriaService;
use App\Application\Service\Country\RegionCriteriaService;
use App\Application\Service\Country\RivalCriteriaService;
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

        $codeService = new CodeCriteriaService(
            "code",
            $countryObject
        );
        $regionService = new RegionCriteriaService(
            "region",
            $countryObject,
            "Europe"
        );
        $populationService =new PopulationCriteriaService(
            "population",
            $countryObject,
            "Asia",
            8e7,
            5e7
        );
        $rivalService = new RivalCriteriaService(
            "rival",
            $countryObject,
            "no"
        );

        $criteria = array(
            $codeService->getCriteriaName() => $codeService->evaluate(),
            $regionService->getCriteriaName() => $regionService->evaluate(),
            $populationService->getCriteriaName() =>
                $populationService->evaluate(),
            $rivalService->getCriteriaName() => $rivalService->evaluate(),
        );
        $strRes = $this->output($criteria);
        return $this->respondWithData($strRes);
    }


    private function output(array $criteria) : string
    {
        $result = true;
        $criteriaObj = array();
        foreach ($criteria as $key => $value) {
            $result = $result && $value;
            $criteriaObj[$key] = $value;
        };

        $objectRes = array(
            'result' => $result,
            $criteriaObj
        );
        $jsonRes = json_encode($objectRes);
        return $jsonRes;
    }

    // private function calculate(Country $country, Country $rival) : string
    // {
    //     $vocals = array('a','e','i','o','u');
    //     $region = "europe";
    //     $population = [8e7, 5e7];
    //     $criteria = [];
        
    //     $criteria[] = in_array(substr($country->getCode(), 0, 1), $vocals);
    //     $criteria[] = $country->getRegion() === $region; //region
    //     $criteria[] = $country->getRegion() === "Asia" ?
    //         $country->getPopulation() >= $population[0]:
    //         $country->getPopulation() >= $population[1];
    //     $criteria[] = $country->getPopulation() > $rival->getPopulation();

    //     $result = true;
    //     foreach ($criteria as $c) {
    //         $result = $result && $c;
    //     };

    //     $objectRes = array(
    //         'result' => $result,
    //         'criteria' => array(
    //             'code' => $criteria[0],
    //             'region' => $criteria[1],
    //             'population' => $criteria[2],
    //             'rival' => $criteria[3]
    //         )
    //     );
    //     $jsonRes = json_encode($objectRes);
    //     return $jsonRes;
    // }
}
