<?php
declare(strict_types=1);

namespace App\Application\Service\Country;

use App\Domain\Country\Country;

interface RivalCriteriaServiceInterface
{
    /**
     * @return bool
     */
    public function evaluate(Country $country, string $rivalCode) : bool;

    /**
     * @return string
     */
    public function getCriteriaName() : string;
}
