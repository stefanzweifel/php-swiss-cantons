<?php declare(strict_types=1);

namespace Wnx\SwissCantons\Tests;

use PHPUnit\Framework\Attributes\Test;
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

    #[Test]
    public function it_sets_language(): void
    {
        $canton = new Canton($this->getExampleCanton());
        $canton->setLanguage('fr');

        $this->assertEquals('fr', $canton->getLanguage());
    }

    #[Test]
    public function it_transformers_uppercase_language_string_to_lowercase(): void
    {
        $canton = new Canton($this->getExampleCanton());
        $canton->setLanguage('DE');

        $this->assertEquals('de', $canton->getLanguage());
    }

    #[Test]
    public function it_only_allows_national_languages(): void
    {
        $this->expectException(InvalidLanguageException::class);

        $canton = new Canton($this->getExampleCanton());
        $canton->setLanguage('es');
    }

    #[Test]
    public function it_sets_and_returns_abbreviation(): void
    {
        $canton = new Canton($this->getExampleCanton());

        $this->assertEquals('ZH', $canton->getAbbreviation());
    }

    #[Test]
    public function it_sets_names_array(): void
    {
        $canton = new Canton($this->getExampleCanton());

        $this->assertEquals(
            $this->getExampleCanton()['name'],
            $canton->getNamesArray()
        );
    }

    #[Test]
    public function it_returns_correct_name_for_given_language(): void
    {
        $canton = new Canton($this->getExampleCanton());

        $this->assertEquals('Zürich', $canton->getName());
        $this->assertEquals('Zürich', $canton->setLanguage('de')->getName());
    }
}
