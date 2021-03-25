<?php
declare(strict_types=1);

namespace App\Application\Service\Country;

use App\Domain\Country\Country;

interface CodeCriteriaServiceInterface
{
    /**
     * @return bool
     */
    public function evaluate(Country $country) : bool;

    /**
     * @return string
     */
    public function getCriteriaName() : string;
}
