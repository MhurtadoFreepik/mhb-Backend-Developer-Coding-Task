<?php
declare(strict_types=1);

namespace App\Application\Service\Country;

use App\Domain\Country\Country;

class PopulationCriteriaService extends CountryCriteriaService
{
    /**
     * @var string $referenceRegion
     */
    private string $referenceRegion;

    /**
     * @var array $populationValues
     */
    private array $populationValues;

    /**
     * @param string $criteriaName
     * @param Country $country
     * @param string $referenceRegion
     * @param float $value1
     * @param float $value2
     */
    public function __construct(
        string $criteriaName,
        Country $country,
        string $referenceRegion,
        float $value1,
        float $value2
    ) {
        parent::__construct($criteriaName, $country);
        $this->referenceRegion = $referenceRegion;
        $this->populationValues = array($value1, $value2);
    }

    /**
     * {@inheritdoc}
     */
    public function evaluate(): bool
    {
        return
            parent::getCountry()->getRegion() === $this->referenceRegion ?
            parent::getCountry()->getPopulation() >= $this->populationValues[0]:
            parent::getCountry()->getPopulation() >= $this->populationValues[1];
    }
}
