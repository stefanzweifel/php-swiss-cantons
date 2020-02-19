<?php

namespace Wnx\SwissCantons;

class CantonSearch
{
    protected array $dataSet;

    public function __construct()
    {
        $this->dataSet = (new Cantons())->getAll();
    }

    public function findByAbbreviation(string $abbreviation): ?Canton
    {
        $result = array_filter($this->dataSet, function (Canton $canton) use ($abbreviation) {
            return $canton->getAbbreviation() === strtoupper($abbreviation);
        });

        if (count($result) === 0) {
            return null;
        }

        return reset($result);
    }

    public function findByName(string $name): ?Canton
    {
        $result = array_filter($this->dataSet, function (Canton $canton) use ($name) {
            return in_array($name, $canton->getNamesArray());
        });

        if (count($result) === 0) {
            return null;
        }

        return reset($result);
    }
}
