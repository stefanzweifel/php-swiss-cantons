<?php

namespace Wnx\SwissCantons\Tests;

use PHPUnit\Framework\TestCase;
use Wnx\SwissCantons\Canton;
use Wnx\SwissCantons\CantonSearch;

class CantonSearchTest extends TestCase
{
    /** @test */
    public function it_finds_canton_by_abbreviation()
    {
        $cantonSearch = new CantonSearch();
        $canton = $cantonSearch->findByAbbreviation('SH');

        $this->assertInstanceOf(Canton::class, $canton);
        $this->assertEquals('SH', $canton->getAbbreviation());
    }

    /** @test */
    public function it_returns_null_if_no_canton_for_abbreviation_was_found()
    {
        $cantonSearch = new CantonSearch();
        $canton = $cantonSearch->findByAbbreviation('foo');

        $this->assertNull($canton);
    }

    /** @test */
    public function it_finds_canton_by_name()
    {
        $cantonSearch = new CantonSearch();
        $canton = $cantonSearch->findByName('Zürich');

        $this->assertInstanceOf(Canton::class, $canton);
        $this->assertEquals('ZH', $canton->getAbbreviation());
        $this->assertEquals('Zürich', $canton->getNamesArray()['de']);
    }

    /** @test */
    public function it_returns_null_if_no_canton_for_name_was_found()
    {
        $cantonSearch = new CantonSearch();
        $canton = $cantonSearch->findByName('foo');

        $this->assertNull($canton);
    }
}
