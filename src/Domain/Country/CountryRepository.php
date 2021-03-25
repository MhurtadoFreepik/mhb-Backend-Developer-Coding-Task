<?php
declare(strict_types=1);

namespace App\Domain\Country;

interface CountryRepository
{
    /**
     * @param string $code
     * @return Country
     * @throws CountryNotFoundException
     */
    public function fetchCountry(string $code) : Country;
}
