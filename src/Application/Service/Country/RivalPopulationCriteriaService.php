<?php
declare(strict_types=1);

namespace App\Application\Service\Country;

use App\Domain\Country\Country;
use App\Domain\Country\CountryRepository;
use App\Infrastructure\Persistence\Country\InMemoryCountryRepository;

class RivalPopulationCriteriaService implements RivalCriteriaServiceInterface
{
    /**
     * @var string
     */
    protected $criteriaName;

    /**
     * @var CountryRepository $countryRepository
     */
    private CountryRepository $countryRepository;

    public function __construct()
    {
        $this->criteriaName = "rival";
        $this->countryRepository = new InMemoryCountryRepository();
    }

    /**
     * {@inheritdoc}
     */
    public function evaluate(Country $country, string $rivalCode): bool
    {
        $rival = $this->countryRepository->fetchCountry($rivalCode);
        return
            $country->getPopulation() >
            $rival->getPopulation();
    }

    /**
     * @return string
     */
    public function getCriteriaName() : string
    {
        return $this->criteriaName;
    }
}
