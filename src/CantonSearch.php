<?php

namespace Wnx\SwissCantons;

class CantonSearch
{
    protected array $dataset;

    public function __construct()
    {
        $this->dataset = (new Cantons())->getAll();
    }

    public function findByAbbreviation(string $abbreviation): ?Canton
    {
        $result = array_filter($this->dataset, function (Canton $value) use ($abbreviation) {
            return $value->getAbbreviation() === strtoupper($abbreviation);
        });

        if (count($result) === 0) {
            return null;
        }

        return reset($result);
    }

    public function findByName(string $name): ?Canton
    {
        $result = array_filter($this->dataset, function (Canton $canton) use ($name) {
            return in_array($name, $canton->getNamesArray());
        });

        if (count($result) === 0) {
            return null;
        }

        return reset($result);
    }
}
