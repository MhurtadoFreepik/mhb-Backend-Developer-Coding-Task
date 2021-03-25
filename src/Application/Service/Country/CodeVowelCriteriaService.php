<?php
declare(strict_types=1);

namespace App\Application\Service\Country;

use App\Domain\Country\Country;

class CodeVowelCriteriaService implements CodeCriteriaServiceInterface
{
    /**
     * @var string
     */
    protected $criteriaName;

    /**
     * @var string
     */
    protected $pattern;

    public function __construct()
    {
        $this->criteriaName = "code";
        $this->pattern = "/^[aeiou]/i";
    }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function evaluate(): bool
    // {
    //     $vocals = array('a','e','i','o','u');
    //     return in_array(substr($this->country->getCode(), 0, 1), $vocals);
    // }

    /**
     * {@inheritdoc}
     */
    public function evaluate(Country $country): bool
    {
        return preg_match(
            $this->pattern,
            substr($country->getCode(), 0, 1)
            ) == 1;
    }

    /**
     * @return string
     */
    public function getCriteriaName() : string
    {
        return $this->criteriaName;
    }
}
