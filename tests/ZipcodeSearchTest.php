<?php declare(strict_types=1);

namespace Wnx\SwissCantons\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Wnx\SwissCantons\ZipcodeSearch;

class ZipcodeSearchTest extends TestCase
{
    #[Test]
    public function it_returns_dataset_as_array(): void
    {
        $cantonSearch = new ZipcodeSearch();

        $this->assertIsArray($cantonSearch->getDataSet());
    }

    #[Test]
    public function it_finds_canton_by_zipcode(): void
    {
        $zipcodeSearch = new ZipcodeSearch();

        $result = $zipcodeSearch->findByZipcode(3005);

        $this->assertIsArray($result);
        $this->assertEquals('BE', $result['canton']);
        $this->assertEquals('Bern', $result['city']);
    }

    #[Test]
    public function it_does_not_find_result_for_not_available_zipcode(): void
    {
        $zipcodeSearch = new ZipcodeSearch();

        $result = $zipcodeSearch->findByZipcode(99999);

        $this->assertEquals(null, $result);
    }

    #[Test]
    public function it_does_not_find_liechtenstein_zipcodes(): void
    {
        $zipcodeSearch = new ZipcodeSearch();

        $result = $zipcodeSearch->findByZipcode(9494);

        $this->assertNull($result);
    }
}
