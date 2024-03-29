<?php declare(strict_types=1);

namespace Wnx\SwissCantons\Tests;

use Exception;
use PHPUnit\Framework\Attributes\Test;
use Wnx\SwissCantons\Cantons;
use PHPUnit\Framework\TestCase;

class CantonsTest extends TestCase
{
    #[Test]
    public function it_returns_json_source_as_array()
    {
        $cantons = new Cantons();

        $this->assertTrue(is_array($cantons->getAll()));
    }

    #[Test]
    public function it_contains_abbreviation_and_name()
    {
        $cantons = (new Cantons())->getAll();

        $this->assertEquals('AG', $cantons[0]->getAbbreviation());
        $this->assertArrayHasKey('de', $cantons[0]->getNamesArray());
        $this->assertArrayHasKey('fr', $cantons[0]->getNamesArray());
        $this->assertArrayHasKey('it', $cantons[0]->getNamesArray());
        $this->assertArrayHasKey('rm', $cantons[0]->getNamesArray());
        $this->assertArrayHasKey('en', $cantons[0]->getNamesArray());
    }

    #[Test]
    public function it_returns_an_array_with_abbreviation_as_key_and_name_as_value()
    {
        $cantons = (new Cantons())->getAllAsArray();

        $this->assertArrayHasKey('SH', $cantons);
        $this->assertEquals('Schaffhouse', $cantons['SH']);

        $this->assertArrayHasKey('ZH', $cantons);
        $this->assertEquals('Zurich', $cantons['ZH']);
    }

    #[Test]
    public function it_returns_an_array_with_abbreviation_and_name_but_in_a_different_language()
    {
        $cantons = (new Cantons())->getAllAsArray('de');

        $this->assertArrayHasKey('SH', $cantons);
        $this->assertEquals('Schaffhausen', $cantons['SH']);

        $this->assertArrayHasKey('ZH', $cantons);
        $this->assertEquals('Zürich', $cantons['ZH']);
    }

    #[Test]
    public function it_throws_an_exception_if_passed_langauge_is_not_available()
    {
        $this->expectException(Exception::class);

        $cantons = (new Cantons())->getAllAsArray('foo');
    }
}
