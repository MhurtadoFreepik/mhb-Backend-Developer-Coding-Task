<?php
declare(strict_types=1);

namespace App\Application\Actions\Country;

use App\Application\Actions\Action;
use App\Domain\Country\CountryRepository;
use App\Infrastructure\Persistence\Country\InMemoryCountryRepository;
use Psr\Log\LoggerInterface;

abstract class CountryAction extends Action
{
    /**
     * @var CountryRepository
     */
    protected $countryRepository;

    /**
     * @param LoggerInterface $logger
     * @param CountryRepository $countryRepository
     */
    public function __construct(
        LoggerInterface $logger,
        InMemoryCountryRepository $countryRepository
    ) {
        parent::__construct($logger);
        $this->countryRepository = $countryRepository;
    }
}
