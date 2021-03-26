<?php
declare(strict_types=1);

namespace App\Application\Actions\Country;

use App\Domain\Country\Country;
use App\Application\Service\Country\CodeVowelCriteriaService;
use App\Application\Service\Country\PopulationValuesCriteriaService;
use App\Application\Service\Country\RegionNameCriteriaService;
use App\Application\Service\Country\RivalPopulationCriteriaService;
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
        $populationValues = [80000000, 50000000];
        
        $codeService = new CodeVowelCriteriaService();
        $regionService = new RegionNameCriteriaService();
        $populationService =new PopulationValuesCriteriaService();
        $rivalService = new RivalPopulationCriteriaService();

        $criteria = [
            $codeService->getCriteriaName() =>
                $codeService->evaluate($countryObject),
            $regionService->getCriteriaName() =>
                $regionService->evaluate($countryObject, "Europe"),
            $populationService->getCriteriaName() =>
                $populationService-> evaluate($countryObject, "Asia"),
            $rivalService->getCriteriaName() =>
                $rivalService->evaluate($countryObject, "no"),
        ];
        $strRes = $this->output($criteria);
        return $this->respondWithData($strRes);
    }


    private function output(array $criteria) : string
    {
        $result = true;
        $criteriaObj = [];
        foreach ($criteria as $key => $value) {
            $result = $result && $value;
            $criteriaObj[$key] = $value;
        };

        $objectRes = [
            'result' => $result,
            'criteria' => $criteriaObj
        ];
        $jsonRes = json_encode($objectRes);
        return $jsonRes;
    }
}
