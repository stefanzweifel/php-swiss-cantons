<?php

namespace Wnx\SwissCantons;

class Cantons
{
    /**
     * Array of Cantons
     * @var array
     */
    protected $cantons;

    public function __construct()
    {
        $this->cantons = json_decode(file_get_contents(__DIR__.'/data/cantons.json'));
    }

    /**
     * Return all Cantons
     * @return array of Wnx\SwissCantons\Canton
     */
    public function getAll()
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
     * Return all Cantons as a one dimensional array of abbreviation and names
     * @param  string $defaultLanguage
     * @return Array
     */
    public function getAllAsArray($defaultLanguage = 'en')
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