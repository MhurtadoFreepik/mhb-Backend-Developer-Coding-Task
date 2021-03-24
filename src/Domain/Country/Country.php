<?php
declare(strict_types=1);

namespace App\Domain\Country;

use JsonSerializable;

class Country implements JsonSerializable
{
    /**
     * @var string|null
     */
    private $code;

    /**
     * @var string
     */
    private $region;

    /**
     * @var int
     */
    private $population;

    /**
     * @param string|null  $code
     * @param string    $region
     * @param int    $population
     */
    public function __construct(?string $code, string $region, int $population)
    {
        $this->code = $code;
        $this->region = strtolower($region);
        //$this->region = ucfirst($this->region);
        $this->population = $population;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @return int
    */
    public function getPopulation() : ?int
    {
        return $this->population;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'code' => $this->code,
            'region' => $this->region,
            'population' => $this->population,
        ];
    }
}
