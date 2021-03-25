<?php
declare(strict_types=1);

namespace App\Application\Service\Country;

use App\Domain\Country\Country;

class PopulationValuesCriteriaService
    implements PopulationCriteriaServiceInterface
{
    /**
     * @var string
     */
    protected $criteriaName;

    /**
     * @var array
     */
    protected $populationValues;

    public function __construct()
    {
        $this->criteriaName = "population";
        $this->populationValues = [80000000, 50000000];
    }

    /**
     * {@inheritdoc}
     */
    public function evaluate(Country $country, string $reference): bool
    {
        $regionService = new RegionNameCriteriaService();
        return $regionService->evaluate($country, $reference) ?
            $country->getPopulation() >= $this->populationValues[0]:
            $country->getPopulation() >= $this->populationValues[1];
    }

    /**
     * @return string
     */
    public function getCriteriaName() : string
    {
        return $this->criteriaName;
    }
}
