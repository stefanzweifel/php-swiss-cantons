<?php declare(strict_types=1);

namespace Wnx\SwissCantons\Tests;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Wnx\SwissCantons\CantonManager;
use Wnx\SwissCantons\Exceptions\CantonException;

class CantonManagerTest extends TestCase
{
    #[Test]
    public function it_returns_correct_canton_instance_for_abbreviation()
    {
        $canton = new CantonManager();
        $canton = $canton->getByAbbreviation('ZH');

        $this->assertEquals(
            'Zürich',
            $canton->setLanguage('de')->getName()
        );
    }

    #[Test]
    public function it_returns_correct_canton_if_abbreviation_is_lowercase()
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
    public function it_throws_exception_if_no_canton_for_abbreviation_is_found()
    {
        $this->expectException(CantonException::class);

        $canton = new CantonManager();
        $result = $canton->getByAbbreviation('FOO');
    }

    #[Test]
    public function it_returns_correct_canton_instance_for_name()
    {
        $canton = new CantonManager();
        $result = $canton->getByName('Zürich');

        $this->assertEquals('ZH', $result->getAbbreviation());
    }

    #[Test]
    public function it_throws_exception_if_not_canton_for_name_is_found()
    {
        $this->expectException(CantonException::class);

        $canton = new CantonManager();
        $result = $canton->getByName('FOO');
    }

    #[Test]
    public function it_returns_canton_for_zipcode()
    {
        $canton = new CantonManager();
        $result = $canton->getByZipcode(3005);

        $this->assertEquals('BE', $result->getAbbreviation());
        $this->assertEquals('Bern', $result->setLanguage('de')->getName());
        $this->assertEquals('Berne', $result->setLanguage('en')->getName());
    }

    #[Test]
    public function it_throws_exception_if_no_canton_for_zipcode_could_be_found()
    {
        $this->expectException(CantonException::class);

        $canton = new CantonManager();
        $result = $canton->getByZipcode(9999);
    }

    #[Test]
    public function it_throws_exception_if_lichtenstein_zipcode_is_searched_for()
    {
        $this->expectException(CantonException::class);

        $canton = new CantonManager();
        $result = $canton->getByZipcode(9494);
    }
}
