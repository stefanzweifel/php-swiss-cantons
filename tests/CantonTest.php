<?php declare(strict_types=1);

namespace Wnx\SwissCantons\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Wnx\SwissCantons\Canton;
use Wnx\SwissCantons\Exceptions\InvalidLanguageException;

class CantonTest extends TestCase
{
    protected function getExampleCanton(): array
    {
        return [
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

    /** @test */
    public function it_only_allows_national_languages()
    {
        $this->expectException(InvalidLanguageException::class);

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

        $this->assertEquals(
            $this->getExampleCanton()['name'],
            $canton->getNamesArray()
        );
    }

    /** @test */
    public function it_returns_correct_name_for_given_language()
    {
        $canton = new Canton($this->getExampleCanton());

        $this->assertEquals('Zürich', $canton->getName());
        $this->assertEquals('Zürich', $canton->setLanguage('de')->getName());
    }
}
