<?php

namespace Wnx\SwissCantons;

class ZipcodeSearch
{
    protected array $data;

    public function __construct()
    {
        $this->data = $this->getDataSet();
    }

    /**
     * Find Data Set for a City by Zipcode.
     *
     * @param int $zipcode
     *
     * @return mixed Returns an object or null if no result was found
     */
    public function findbyZipcode(int $zipcode)
    {
        $result = array_filter($this->data, function (array $value) use ($zipcode) {
            return $value['zipcode'] === intval($zipcode);
        });

        if (count($result) === 0) {
            return;
        }

        return reset($result);
    }

    /**
     * Read Zipcode JSON Data.
     *
     * @return stdClass
     */
    public function getDataSet(): array
    {
        $zipcodes = file_get_contents(__DIR__.'/data/zipcodes.json');

        return json_decode($zipcodes, true);
    }
}
