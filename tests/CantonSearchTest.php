<?php declare(strict_types=1);

namespace Wnx\SwissCantons\Tests;

use PHPUnit\Framework\Attributes\Test;
use Wnx\SwissCantons\Canton;
use PHPUnit\Framework\TestCase;
use Wnx\SwissCantons\CantonSearch;

class CantonSearchTest extends TestCase
{
    #[Test]
    public function it_finds_canton_by_abbreviation()
    {
        $cantonSearch = new CantonSearch();
        $canton = $cantonSearch->findByAbbreviation('SH');

        $this->assertInstanceOf(Canton::class, $canton);
        $this->assertEquals('SH', $canton->getAbbreviation());
    }

    #[Test]
    public function it_returns_null_if_no_canton_for_abbreviation_was_found()
    {
        $cantonSearch = new CantonSearch();
        $canton = $cantonSearch->findByAbbreviation('foo');

        $this->assertNull($canton);
    }

    #[Test]
    public function it_finds_canton_by_name()
    {
        $cantonSearch = new CantonSearch();
        $canton = $cantonSearch->findByName('Zürich');

        $this->assertInstanceOf(Canton::class, $canton);
        $this->assertEquals('ZH', $canton->getAbbreviation());
        $this->assertEquals('Zürich', $canton->getNamesArray()['de']);
    }

    #[Test]
    public function it_returns_null_if_no_canton_for_name_was_found()
    {
        $cantonSearch = new CantonSearch();
        $canton = $cantonSearch->findByName('foo');

        $this->assertNull($canton);
    }
}
