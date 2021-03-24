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
        $mock = m::mock(Country::class);
        $mock->setCode("es");
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
        $this->mock->shouldReceive("setCode");
        assertEquals("es", $this->mock->getCode());
    }
}
