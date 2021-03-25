<?php
declare(strict_types=1);

use App\Domain\Country\CountryRepository;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\Country\InMemoryCountryRepository;
use App\Infrastructure\Persistence\User\InMemoryUserRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(InMemoryUserRepository::class),
        CountryRepository::class =>
            \DI\autowire(InMemoryCountryRepository::class),
    ]);
};
