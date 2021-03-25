<?php
declare(strict_types=1);

use App\Application\Service\Country\CodeVowelCriteriaService;
use App\Domain\Country\Country;
use \Mockery as m;
use PHPUnit\Framework\TestCase;

class CodeVowelCriteriaServiceTest extends TestCase
{
    protected array $countries;
    protected $mock;
    protected Country $country;

    public function trueCodeProvider()
    {
        return [
            ["es", "Europe", 7513752572],
            ["ad", "Europe", 4256318],
            ["at", "Europe", 35478652817],
            ["am", "Europe", 50757135100],
        ];
    }

    public function falseCodeProvider()
    {
        return [
            ["be", "Europe", 7513752572],
            ["jpn", "Asia", 4256318],
            ["cn", "Europe", 35478652817],
            ["cg", "Africa", 50757135100],
        ];
    }

    public function inValidCodeProvider()
    {
        return [
            ["1a", "Europe", 7513752572],
            ["2b", "Asia", 4256318],
            ["3c", "Europe", 35478652817],
            ["4d", "Europe", 50757135100],
        ];
    }

    public function setUp() : void
    {
        parent::setUpBeforeClass();
        $this->mock = m::mock(CodeVowelCriteriaService::class);
    }
    
    public function tearDown() : void
    {
        parent::tearDown();
        m::close();
    }

    /**
     * @dataProvider trueCodeProvider
     * @param string $code
     */
    public function testCodeStartsWithVowel(
        string $code,
        string $region,
        int $population
    ) {
        $this->country = new Country($code, $region, $population);
        $this->mock->shouldReceive("evaluate")->andReturn(true);
        TestCase::assertTrue(
            $this->mock->evaluate($this->country)
        );
    }

    /**
     * @dataProvider falseCodeProvider
     * @param string $code
     */
    public function testCodeDoesNotStartWithVowel(
        string $code,
        string $region,
        int $population
    ) {
        $this->country = new Country($code, $region, $population);
        $this->mock->shouldReceive("evaluate")->andReturn(false);
        TestCase::assertFalse(
            $this->mock->evaluate($this->country)
        );
    }

    /**
     * @dataProvider inValidCodeProvider
     * @param string $code
     */
    public function testInvalidCodeThrowsException(
        string $code,
        string $region,
        int $population
    ) {
        $this->expectException(InvalidArgumentException::class);
        $this->country = new Country($code, $region, $population);
        $this->mock->shouldReceive("evaluate")
            ->andThrow(new InvalidArgumentException());
        $this->mock->evaluate($this->country);
    }
}
