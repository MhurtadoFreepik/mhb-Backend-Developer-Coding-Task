<?php
declare(strict_types=1);

namespace App\Application\Service\Country;

use App\Domain\Country\Country;

abstract class CountryCriteriaService
{
    /**
     * @var string
     */
    protected $criteriaName;

    /**
     * @var Country $country
     */
    protected $country;

    /**
     * @param string $criteriaName
     */
    public function __construct(string $criteriaName, Country $country)
    {
        $this->criteriaName = $criteriaName;
        $this->country = $country;
    }

    /**
     * @return bool
     */
    abstract public function evaluate() : bool;
}
