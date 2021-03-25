<?php
declare(strict_types=1);

use App\Application\Service\Country\RivalPopulationCriteriaService;
use App\Domain\Country\Country;
use App\Domain\Country\CountryRepository;
use App\Infrastructure\Persistence\Country\InMemoryCountryRepository;

use \Mockery as m;
use PHPUnit\Framework\TestCase;

class RivalPopulationCriteriaServiceTest extends TestCase
{
    protected array $countries;
    protected $mock;
    protected Country $country;
    protected string $rivalCode;
    private CountryRepository $countryRepository;

    public function winnerCountryProvider()
    {
        return [
            ["es", "Europe", 7513752572],
            ["gb", "Europe", 4256318],
            ["de", "Europe", 35478652817],
            ["fr", "Europe", 50757135100],
        ];
    }

    public function loserCountryProvider()
    {
        return [
            ["ad", "Europe", 7513752572],
            ["sm", "Europe", 4256318],
            ["mc", "Europe", 35478652817],
            ["li", "Europe", 50757135100],
        ];
    }

    public function setUp() : void
    {
        parent::setUpBeforeClass();
        $this->rivalCode = "no"; //Norway
        $this->countryRepository = new InMemoryCountryRepository();
        $this->mock = m::mock(RivalPopulationCriteriaService::class);
    }
    
    public function tearDown() : void
    {
        parent::tearDown();
        m::close();
    }

    /**
     * @dataProvider winnerCountryProvider
     * @param string $code
     */
    public function testCountryHasMorePopulationThanRival(string $code)
    {
        $this->country = $this->countryRepository->fetchCountry($code);
        $this->mock->shouldReceive("evaluate")->andReturn(true);
        TestCase::assertTrue(
            $this->mock->evaluate($this->country, $this->rivalCode)
        );
    }

    /**
     * @dataProvider loserCountryProvider
     * @param string $code
     */
    public function testCountryHasLessPopulationThanRival(string $code)
    {
        $this->country = $this->countryRepository->fetchCountry($code);
        $this->mock->shouldReceive("evaluate")->andReturn(false);
        TestCase::assertFalse(
            $this->mock->evaluate($this->country, $this->rivalCode)
        );
    }

    public function testRivalLosesToItself()
    {
        $this->country =
            $this->countryRepository->fetchCountry($this->rivalCode);
        $this->mock->shouldReceive("evaluate")->andReturn(false);
        TestCase::assertFalse(
            $this->mock->evaluate($this->country, $this->rivalCode)
        );
    }
}
