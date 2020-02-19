<?php

namespace Wnx\SwissCantons\Tests;

use PHPUnit\Framework\TestCase;
use Wnx\SwissCantons\ZipcodeSearch;

class ZipcodeSearchTest extends TestCase
{
    /** @test */
    public function it_returns_dataset_as_array()
    {
        $cantonSearch = new ZipcodeSearch();

        $this->assertIsArray($cantonSearch->getDataSet());
    }

    /** @test */
    public function it_finds_canton_by_zipcode()
    {
        $zipcodeSearch = new ZipcodeSearch();

        $result = $zipcodeSearch->findByZipcode(3005);

        $this->assertIsArray($result);
        $this->assertEquals('BE', $result['canton']);
        $this->assertEquals('Bern', $result['community_name']);
    }

    /** @test */
    public function it_finds_canton_if_zipcode_is_passed_as_a_string()
    {
        $zipcodeSearch = new ZipcodeSearch();

        $result = $zipcodeSearch->findByZipcode('3005');

        $this->assertIsArray($result);
        $this->assertEquals('BE', $result['canton']);
        $this->assertEquals('Bern', $result['community_name']);
    }

    /** @test */
    public function it_does_not_find_result_for_not_available_zipcode()
    {
        $zipcodeSearch = new ZipcodeSearch();

        $result = $zipcodeSearch->findByZipcode(99999);

        $this->assertEquals(null, $result);
    }

    /** @test */
    public function it_finds_lichtenstein_zipcodes()
    {
        $zipcodeSearch = new ZipcodeSearch();

        $result = $zipcodeSearch->findByZipcode(9494);

        $this->assertEquals('LI', $result['canton']);
    }
}
