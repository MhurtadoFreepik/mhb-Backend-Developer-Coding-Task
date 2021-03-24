<?php
declare(strict_types=1);

namespace App\Application\Service\Country;

use App\Domain\Country\Country;
use App\Domain\Country\CountryRepository;
use App\Infrastructure\Persistence\Country\InMemoryCountryRepository;

class RivalCriteriaService extends CountryCriteriaService
{
    /**
     * @var Country $rival
     */
    private Country $rival;

    /**
     * @var Country $rival
     */
    private CountryRepository $countryRepository;

    /**
     * @param string $criteriaName
     * @param Country $country
     * @param string $code
     */
    public function __construct(
        string $criteriaName,
        Country $country,
        string $code
    ) {
        parent::__construct($criteriaName, $country);
        $this->countryRepository = new InMemoryCountryRepository();
        $this->rival = $this->countryRepository->fetchCountry($code);
    }

    /**
     * {@inheritdoc}
     */
    public function evaluate(): bool
    {
        return
            parent::getCountry()->getPopulation() >
            $this->rival->getPopulation();
    }
}
