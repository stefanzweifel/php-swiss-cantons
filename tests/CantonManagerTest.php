<?php

namespace Wnx\SwissCantons\Tests;

use PHPUnit\Framework\TestCase;
use Wnx\SwissCantons\CantonManager;

class CantonManagerTest extends TestCase
{
    /** @test */
    public function it_returns_correct_canton_instance_for_abbreviation()
    {
        $canton = new CantonManager();
        $canton = $canton->getByAbbreviation('ZH');

        $this->assertEquals(
            'Zürich',
            $canton->setLanguage('de')->getName()
        );
    }

    /** @test */
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

    /**
     * @test
     * @expectedException     Exception
     */
    public function it_throws_exception_if_no_canton_for_abbreviation_is_found()
    {
        $canton = new CantonManager();
        $result = $canton->getByAbbreviation('FOO');
    }

    /** @test */
    public function it_returns_correct_canton_instance_for_name()
    {
        $canton = new CantonManager();
        $result = $canton->getByName('Zürich');

        $this->assertEquals('ZH', $result->getAbbreviation());
    }

    /**
     * @test
     * @expectedException     Exception
     */
    public function it_throws_exception_if_not_canton_for_name_is_found()
    {
        $canton = new CantonManager();
        $result = $canton->getByName('FOO');
    }

    /** @test */
    public function it_returns_canton_for_zipcode()
    {
        $canton = new CantonManager();
        $result = $canton->getByZipcode(3005);

        $this->assertEquals('BE', $result->getAbbreviation());
        $this->assertEquals('Bern', $result->setLanguage('de')->getName());
        $this->assertEquals('Berne', $result->setLanguage('en')->getName());
    }

    /**
     * @test
     * @expectedException     Exception
     */
    public function it_throws_exception_if_no_canton_for_zipcode_could_be_found()
    {
        $canton = new CantonManager();
        $result = $canton->getByZipcode(8000);
    }
}
