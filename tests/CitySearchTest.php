<?php declare(strict_types=1);

namespace Wnx\SwissCantons\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Wnx\SwissCantons\CitySearch;

class CitySearchTest extends TestCase
{
    #[Test]
    public function it_returns_dataset_as_array(): void
    {
        $citySearch = new CitySearch();

        $this->assertIsArray($citySearch->getDataSet());
    }

    #[Test]
    public function it_finds_cities_by_zipcode(): void
    {
        $citySearch = new CitySearch();

        $result = $citySearch->findByZipcode(3005);

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertArrayHasKey(0, $result);

        $city = $result[0];

        $this->assertArrayHasKey('canton', $city);
        $this->assertArrayHasKey('city', $city);
        $this->assertArrayHasKey('zipcode', $city);

        $this->assertEquals('BE', $city['canton']);
        $this->assertEquals('Bern', $city['city']);
    }

    #[Test]
    public function it_does_not_find_result_for_not_available_zipcode(): void
    {
        $citySearch = new CitySearch();

        $result = $citySearch->findByZipcode(99999);

        $this->assertEmpty($result);
    }

    #[Test]
    public function it_does_not_find_liechtenstein_zipcodes(): void
    {
        $citySearch = new CitySearch();

        $result = $citySearch->findByZipcode(9494);

        $this->assertEmpty($result);
    }

}
