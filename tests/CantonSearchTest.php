<?php

namespace Wnx\SwissCantons\Tests;

use Wnx\SwissCantons\CantonSearch;
use Illuminate\Support\Collection;

class CantonSearchTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_returns_json_source_as_colection()
    {
        $cantonSearch = new CantonSearch();
        $this->assertInstanceOf(Collection::class, $cantonSearch->getDataSet());
    }

    /** @test */
    public function it_finds_canton_by_abbreviation()
    {
        $cantonSearch = new CantonSearch();
        $canton = $cantonSearch->findByAppreviation("SH");

        $this->assertInstanceOf(\stdClass::class, $canton);
        $this->assertEquals("SH", $canton->abbreviation);
    }

    /** @test */
    public function it_returns_null_if_no_canton_for_abbreviation_was_found()
    {
        $cantonSearch = new CantonSearch();
        $canton = $cantonSearch->findByAppreviation("foo");

        $this->assertNull($canton);
    }

    /** @test */
    public function it_finds_canton_by_name()
    {
        $cantonSearch = new CantonSearch();
        $canton = $cantonSearch->findByName("Zürich");

        $this->assertInstanceOf(\stdClass::class, $canton);
        $this->assertEquals("ZH", $canton->abbreviation);
        $this->assertEquals("Zürich", $canton->name->de);
    }

    /** @test */
    public function it_returns_null_if_no_canton_for_name_was_found()
    {
        $cantonSearch = new CantonSearch();
        $canton = $cantonSearch->findByName("foo");

        $this->assertNull($canton);
    }

}
