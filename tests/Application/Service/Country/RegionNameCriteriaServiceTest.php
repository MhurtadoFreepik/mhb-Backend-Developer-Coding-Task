<?php
declare(strict_types=1);

use App\Application\Service\Country\RegionNameCriteriaService;
use App\Domain\Country\Country;
use \Mockery as m;
use PHPUnit\Framework\TestCase;

class RegionNameCriteriaServiceTest extends TestCase
{
    protected array $countries;
    protected $mock;
    protected Country $country;
    protected string $region;

    public function trueRegionProvider()
    {
        return [
            ["es", "Europe", 7513752572],
            ["ad", "Europe", 4256318],
            ["at", "Europe", 35478652817],
            ["am", "Europe", 50757135100],
        ];
    }

    public function falseRegionProvider()
    {
        return [
            ["cd", "Africa", 7513752572],
            ["jpn", "Asia", 4256318],
            ["cn", "Asia", 35478652817],
            ["cg", "Africa", 50757135100],
        ];
    }

    public function inValidCodeProvider()
    {
        return [
            ["1a", "5", 7513752572],
            ["2b", "Asia", 4256318],
            ["3c", "Europe", 35478652817],
            ["4d", "Europe", 50757135100],
        ];
    }

    public function setUp() : void
    {
        parent::setUpBeforeClass();
        $this->region = "Europe";
        $this->mock = m::mock(RegionNameCriteriaService::class);
    }
    
    public function tearDown() : void
    {
        parent::tearDown();
        m::close();
    }

    /**
     * @dataProvider trueRegionProvider
     * @param string $code
     */
    public function testRegionIsEqual(
        string $code,
        string $region,
        int $population
    ) {
        $this->country = new Country($code, $region, $population);
        $this->mock->shouldReceive("evaluate")->andReturn(true);
        TestCase::assertTrue(
            $this->mock->evaluate($this->country, $this->region)
        );
    }

    /**
     * @dataProvider falseRegionProvider
     * @param string $code
     */
    public function testRegionIsNotEqual(
        string $code,
        string $region,
        int $population
    ) {
        $this->country = new Country($code, $region, $population);
        $this->mock->shouldReceive("evaluate")->andReturn(false);
        TestCase::assertFalse(
            $this->mock->evaluate($this->country, $this->region)
        );
    }
}
