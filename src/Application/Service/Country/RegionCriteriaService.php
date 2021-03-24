<?php
declare(strict_types=1);

namespace App\Application\Service\Country;

use App\Domain\Country\Country;

class RegionCriteriaService extends CountryCriteriaService
{
    /**
     * @var string $region
     */
    private string $region;


    /**
     * @param string $criteriaName
     * @param Country $country
     */
    public function __construct(
        string $criteriaName,
        Country $country,
        string $region
    ) {
        parent::__construct($criteriaName, $country);
        $this->region = $region;
    }

    /**
     * {@inheritdoc}
     */
    public function evaluate(): bool
    {
        return strtolower(parent::getCountry()->getRegion())
            === strtolower($this->region);
    }
}
