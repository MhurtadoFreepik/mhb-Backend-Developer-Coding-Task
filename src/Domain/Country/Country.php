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
     * Set the value of population
     *
     * @param  int  $population
     *
     * @return  self
     */
    public function setPopulation(int $population)
    {
        $this->population = $population;

        return $this;
    }

    /**
     * Set the value of region
     *
     * @param  string  $region
     *
     * @return  self
     */
    public function setRegion(string $region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Set the value of code
     *
     * @param  string|null  $code
     *
     * @return  self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
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
