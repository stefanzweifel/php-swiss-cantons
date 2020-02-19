<?php

namespace Wnx\SwissCantons;

class Cantons
{
    protected array $cantons;

    public function __construct()
    {
        $this->cantons = json_decode(file_get_contents(__DIR__.'/data/cantons.json'), true);
    }

    /**
     * Return all Cantons.
     *
     * @return array<Wnx\SwissCantons\Canton>
     */
    public function getAll(): array
    {
        $cantons = $this->cantons;
        $resultArray = [];

        foreach ($cantons as $canton) {
            $canton = new Canton($canton);

            $resultArray[] = $canton;
        }

        return $resultArray;
    }

    /**
     * Return all Cantons as a one dimensional array of abbreviation and names.
     */
    public function getAllAsArray(string $defaultLanguage = 'en'): array
    {
        $cantons = $this->getAll();
        $resultArray = [];

        foreach ($cantons as $canton) {
            $canton->setLanguage($defaultLanguage);
            $resultArray[$canton->getAbbreviation()] = $canton->getName();
        }

        return $resultArray;
    }
}
