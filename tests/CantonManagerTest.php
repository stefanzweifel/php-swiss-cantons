<?php declare(strict_types=1);

namespace Wnx\SwissCantons\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Wnx\SwissCantons\Canton;
use Wnx\SwissCantons\CantonManager;
use Wnx\SwissCantons\Exceptions\CantonNotFoundException;

class CantonManagerTest extends TestCase
{
    #[Test]
    public function it_returns_correct_canton_instance_for_abbreviation(): void
    {
        $cantonManager = new CantonManager();
        $canton = $cantonManager->getByAbbreviation('ZH');

        $this->assertEquals(
            'Zürich',
            $canton->setLanguage('de')->getName()
        );
    }

    #[Test]
    public function it_returns_correct_canton_if_abbreviation_is_lowercase(): void
    {
        $cantonManager = new CantonManager();

        $canton = $cantonManager->getByAbbreviation('zh');
        $this->assertEquals(
            'Zürich',
            $canton->setLanguage('de')->getName()
        );

        $canton = $cantonManager->getByAbbreviation('gr');
        $this->assertEquals(
            'Graubünden',
            $canton->setLanguage('de')->getName()
        );

        $canton = $cantonManager->getByAbbreviation('sh');
        $this->assertEquals(
            'Schaffhausen',
            $canton->setLanguage('de')->getName()
        );
    }

    #[Test]
    public function it_throws_exception_if_no_canton_for_abbreviation_is_found(): void
    {
        $this->expectException(CantonNotFoundException::class);

        $canton = new CantonManager();
        $result = $canton->getByAbbreviation('FOO');
    }

    #[Test]
    public function it_returns_correct_canton_instance_for_name(): void
    {
        $canton = new CantonManager();
        $result = $canton->getByName('Zürich');

        $this->assertEquals('ZH', $result->getAbbreviation());
    }

    #[Test]
    public function it_throws_exception_if_not_canton_for_name_is_found(): void
    {
        $this->expectException(CantonNotFoundException::class);

        $canton = new CantonManager();
        $result = $canton->getByName('FOO');
    }

    #[Test]
    public function it_returns_canton_for_zipcode(): void
    {
        $cantonManager = new CantonManager();
        $result = $cantonManager->getByZipcode(3005);

        $this->assertCount(1, $result);

        $canton = $result[0];

        $this->assertEquals('BE', $canton->getAbbreviation());
        $this->assertEquals('Bern', $canton->setLanguage('de')->getName());
        $this->assertEquals('Berne', $canton->setLanguage('en')->getName());
    }

    #[Test]
    public function it_throws_exception_if_no_canton_for_zipcode_could_be_found(): void
    {
        $this->expectException(CantonNotFoundException::class);

        $canton = new CantonManager();
        $result = $canton->getByZipcode(9999);
    }

    #[Test]
    public function it_throws_exception_if_lichtenstein_zipcode_is_searched_for(): void
    {
        $this->expectException(CantonNotFoundException::class);

        $cantonManager = new CantonManager();
        $result = $cantonManager->getByZipcode(9494);
    }

    #[Test]
    public function it_returns_different_cantons_for_zipcode_1290(): void
    {
        $cantonManager = new CantonManager();

        // Zipcode 1290 refers to Versoix in Geneva and Chavanne-des-Bois in Vaud
        $result = $cantonManager->getByZipcode(1290);

        $this->assertCount(2, $result);

        $cantonAbbreviations = array_map(fn (Canton $canton) => $canton->getAbbreviation(), $result);
        $this->assertContains('VD', $cantonAbbreviations);
        $this->assertContains('GE', $cantonAbbreviations);
    }

    #[Test]
    public function it_finds_single_canton_with_zipcode_and_city(): void
    {
        $cantonManager = new CantonManager();

        $canton = $cantonManager->getByZipcodeAndCity(1290, 'Versoix');

        $this->assertEquals('GE', $canton->getAbbreviation());
    }

    #[Test]
    public function it_finds_single_canton_with_zipcode(): void
    {
        $cantonManager = new CantonManager();

        $canton = $cantonManager->getByZipcodeAndCity(1003);

        $this->assertEquals('VD', $canton->getAbbreviation());
    }

    #[Test]
    public function it_throws_exception_if_no_single_canton_for_zipcode_could_be_found(): void
    {
        $this->expectException(CantonNotFoundException::class);

        $canton = new CantonManager();

        $canton->getByZipcodeAndCity(9999);
    }

    #[Test]
    public function it_throws_exception_if_no_canton_for_zipcode_and_city_could_be_found(): void
    {
        $this->expectException(CantonNotFoundException::class);

        $canton = new CantonManager();

        $canton->getByZipcodeAndCity(1290, 'Lausanne');
    }
}
