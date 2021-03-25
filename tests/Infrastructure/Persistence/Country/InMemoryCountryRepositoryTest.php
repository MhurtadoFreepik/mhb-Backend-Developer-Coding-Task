<?php
declare(strict_types=1);

use App\Domain\Country\Country;
use App\Infrastructure\Persistence\Country\InMemoryCountryRepository;
use \Mockery as m;
use PHPUnit\Framework\TestCase;

class InMemoryCountryRepositoryTest extends TestCase
{
    protected array $countries;
    protected $mock;
    protected Country $country;

    public function codeProvider()
    {
        return [
            ["es", "Europe", 7513752572],
            ["jpn", "Asia", 4256318],
            ["gb", "Europe", 35478652817],
            ["no", "Europe", 50757135100],
        ];
    }

    public function setUp() : void
    {
        parent::setUpBeforeClass();
        // $this->country = new Country("es", "Europe", 40000000);
        $this->mock = m::mock(InMemoryCountryRepository::class);
    }
    
    public function tearDown() : void
    {
        parent::tearDown();
        m::close();
    }

    /**
     * @dataProvider codeProvider
     * @param string $code
     */
    public function testFetchCountry(
        string $code,
        string $region,
        int $population
    ) {
        $this->country = new Country($code, $region, $population);
        $this->mock->shouldReceive("fetchCountry")->andReturn($this->country);
        TestCase::assertEquals(
            $this->country,
            $this->mock->fetchCountry($code)
        );
    }
}
