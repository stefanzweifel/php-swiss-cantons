<?php

namespace Wnx\SwissCantons\Tests;

use Wnx\SwissCantons\Canton;
use PHPUnit\Framework\TestCase;

class CantonTest extends TestCase
{
    /**
     * Build an Example Dataset.
     *
     * @return object
     */
    protected function getExampleCanton()
    {
        return (object) [
            'abbreviation' => 'ZH',
            'name'         => [
                'de' => 'Zürich',
                'fr' => 'Zürich',
                'it' => 'Zürich',
                'en' => 'Zürich',
                'rm' => 'Zürich',
            ],
        ];
    }

    /** @test */
    public function it_sets_language()
    {
        $canton = new Canton($this->getExampleCanton());
        $canton->setLanguage('fr');

        $this->assertEquals('fr', $canton->getLanguage());
    }

    /** @test */
    public function it_transformers_uppercase_language_string_to_lowercase()
    {
        $canton = new Canton($this->getExampleCanton());
        $canton->setLanguage('DE');

        $this->assertEquals('de', $canton->getLanguage());
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

        $this->assertEquals('ZH', $canton->getAbbreviation());
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

        $this->assertEquals('Zürich', $canton->getName());
        $this->assertEquals('Zürich', $canton->setLanguage('de')->getName());
    }
}
