<?php
declare(strict_types=1);

namespace App\Domain\Country;

use App\Domain\DomainException\DomainRecordNotFoundException;

class CountryNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'Invalid country code, check https://www.iban.com/country-codes for a list of country codes';
}
