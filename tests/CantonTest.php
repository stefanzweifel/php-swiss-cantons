<?php

namespace Wnx\SwissCantons\Tests;

use Wnx\SwissCantons\Canton;
use Illuminate\Support\Collection;

class CantonTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Build an Example Dataset
     * @return object
     */
    protected function getExampleCanton()
    {
        $namesCollection = new Collection([
            "de" => "Zürich",
            "fr" => "Zürich",
            "it" => "Zürich",
            "en" => "Zürich",
            "rm" => "Zürich"
        ]);

        $canton = new Collection([[
            "abbreviation" => "ZH",
            "name" => $namesCollection->all()
        ]]);

        return (object) $canton->first();
    }

    /** @test */
    public function it_sets_language()
    {
        $canton = new Canton($this->getExampleCanton());
        $canton->setLanguage('fr');

        $this->assertEquals('fr', $canton->getLanguage());
    }

    /**
     * @test
     * @expectedException     Exception
     */
    public function it_only_allows_national_languages()
    {
        $canton = new Canton($this->getExampleCanton());
        $canton->setLanguage('es');
    }

    /** @test */
    public function it_sets_and_returns_abbreviation()
    {
        $canton = new Canton($this->getExampleCanton());

        $this->assertEquals("ZH", $canton->getAbbreviation());
    }

    /** @test */
    public function it_sets_names_array()
    {
        $canton = new Canton($this->getExampleCanton());

        $this->assertEquals($this->getExampleCanton()->name, $canton->getNamesArray());
    }

    /** @test */
    public function it_returns_correct_name_for_given_language()
    {
        $canton = new Canton($this->getExampleCanton());

        $this->assertEquals("Zürich", $canton->getName());
        $this->assertEquals("Zürich", $canton->setLanguage('de')->getName());
    }

}
