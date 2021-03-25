<?php
declare(strict_types=1);

namespace App\Application\Service\Country;

use App\Domain\Country\Country;

class RegionNameCriteriaService implements RegionCriteriaServiceInterface
{

    /**
     * @var string
     */
    protected $criteriaName;

    public function __construct()
    {
        $this->criteriaName = "region";
    }

    /**
     * {@inheritdoc}
     */
    public function evaluate(Country $country, string $reference): bool
    {
        return strtolower($country->getRegion()) === strtolower($reference);
    }

    /**
     * @return string
     */
    public function getCriteriaName() : string
    {
        return $this->criteriaName;
    }
}
