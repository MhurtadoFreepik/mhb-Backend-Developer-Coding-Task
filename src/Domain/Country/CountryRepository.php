<?php
declare(strict_types=1);

namespace App\Domain\Country;

interface CountryRepository
{
    /**
     * @return Country[]
     */
    public function findAll(): array;

    /**
     * @param string $id
     * @return Country
     * @throws CountryNotFoundException
     */
    public function findCountryOfId(string $id): Country;

    /**
     * @param string $code
     * @return Country
     * @throws CountryNotFoundException
     */
    public function fetchCountry(string $code) : Country;
}
