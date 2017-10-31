<?php

namespace Wnx\SwissCantons;

class CantonSearch
{
    /**
     * Data Set used to search a Canton.
     *
     * @var stdClass
     */
    protected $data;

    public function __construct()
    {
        $this->data = (new Cantons())->getAll();
    }

    /**
     * Find Canton by Abbreviation.
     *
     * @param string $abbreviation
     *
     * @return mixed Returns an object or null, if no canton was found
     */
    public function findByAbbreviation($abbreviation)
    {
        $result = array_filter($this->data, function (Canton $value) use ($abbreviation) {
            return $value->getAbbreviation() === strtoupper($abbreviation);
        });

        if (empty($result)) {
            return;
        }

        return reset($result);
    }

    /**
     * Find Canton by Name.
     *
     * @param string $name
     *
     * @return mixed Returns an object or null, if no canton was found
     */
    public function findByName($name)
    {
        $result = array_filter($this->data, function (Canton $canton) use ($name) {
            return in_array($name, (array) $canton->getNamesArray());
        });

        if (empty($result)) {
            return;
        }

        return reset($result);
    }
}
