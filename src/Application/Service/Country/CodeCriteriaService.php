<?php
declare(strict_types=1);

namespace App\Application\Service\Country;

class CodeCriteriaService extends CountryCriteriaService
{
    /**
     * {@inheritdoc}
     */
    public function evaluate(): bool
    {
        $vocals = array('a','e','i','o','u');
        return in_array(substr($this->country->getCode(), 0, 1), $vocals);
    }
}
