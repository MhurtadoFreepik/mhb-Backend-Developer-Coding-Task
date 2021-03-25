<?php
declare(strict_types=1);

use App\Domain\Country\Country;
use \Mockery as m;
use PHPUnit\Framework\TestCase;

class CountryTest extends TestCase
{
    protected array $countries;
    protected $mock;
    
    public function setUp() : void
    {
        parent::setUpBeforeClass();
        $this->mock = m::mock(Country::class);
        $this->mock->shouldReceive("getCode")->andReturn("ES");
        $this->mock->shouldReceive("getRegion")->andReturn("Europe");
        $this->mock->shouldReceive("getPopulation")->andReturn(5000);
        // $this-> countries = [
        //             ["JP", "Asia", 126865000],
        //             ["ES", "Europe", 46439864],
        //             ["NO", "Europe", 5176998],
        //         ];
    }
    
    public function tearDown() : void
    {
        parent::tearDown();
        m::close();
    }
    public function testGetCode()
    {
        $code = "ES";
        TestCase::assertEquals($code, $this->mock->getCode());
    }

    public function testGetRegion()
    {
        $region = "Europe";
        TestCase::assertEquals($region, $this->mock->getRegion());
    }

    public function testGetPopulation()
    {
        $population = 5000;
        TestCase::assertEquals($population, $this->mock->getPopulation());
    }
}
