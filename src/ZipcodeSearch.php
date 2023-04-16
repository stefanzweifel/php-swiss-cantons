<?php declare(strict_types=1);

namespace Wnx\SwissCantons;

class ZipcodeSearch
{
    protected array $dataSet;

    public function __construct()
    {
        $this->dataSet = $this->getDataSet();
    }

    /**
     * Find Data Set for a City by Zipcode.
     */
    public function findbyZipcode(int $zipcode): ?array
    {
        $result = array_filter($this->dataSet, fn (array $city) => $city['zipcode'] === intval($zipcode));

        if (count($result) === 0) {
            return null;
        }

        return reset($result);
    }

    public function getDataSet(): array
    {
        return json_decode(file_get_contents(__DIR__.'/data/zipcodes.json'), true, 512, JSON_THROW_ON_ERROR);
    }
}
