<?php

namespace Wnx\SwissCantons\Tests;

use Wnx\SwissCantons\SwissCantons;
use Illuminate\Support\Collection;

class SwissCantonsTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_sets_language()
    {
        $canton = new SwissCantons();
        $canton->setLanguage('fr');

        $this->assertEquals('fr', $canton->getLanguage());
    }

    /**
     * @test
     * @expectedException     Exception
     */
    public function it_only_allows_national_languages()
    {
        $canton = new SwissCantons();
        $canton->setLanguage('es');
    }

    /** @test */
    public function it_returns_json_data_as_collection()
    {
        $canton = new SwissCantons();
        $data = $canton->getData();

        $this->assertInstanceOf(Collection::class, $data);
    }

    /** @test */
    public function it_returns_correct_canton_instance_for_abbreviation()
    {
        $canton = new SwissCantons();
        $result = $canton->getByAppreviation('ZH');

        $this->assertEquals("Zürich", $result->name->de);
    }

    /**
     * @test
     * @expectedException     Exception
     */
    public function it_throws_exception_if_no_canton_for_appreviation_is_found()
    {
        $canton = new SwissCantons();
        $result = $canton->getByAppreviation('FOO');
    }

    /** @test */
    public function it_returns_correct_canton_instance_for_name()
    {
        $canton = new SwissCantons();
        $result = $canton->getByName('Zürich');

        $this->assertEquals("ZH", $result->abbreviation);
    }
}
