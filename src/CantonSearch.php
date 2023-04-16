<?php declare(strict_types=1);

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
        $result = array_filter($this->dataSet, fn (Canton $canton) => $canton->getAbbreviation() === strtoupper($abbreviation));

        if (count($result) === 0) {
            return null;
        }

        return reset($result);
    }

    public function findByName(string $name): ?Canton
    {
        $result = array_filter($this->dataSet, fn (Canton $canton) => in_array($name, $canton->getNamesArray()));

        if (count($result) === 0) {
            return null;
        }

        return reset($result);
    }
}
