<?php

namespace Wnx\SwissCantons;

class ZipcodeSearch
{
    /**
     * Data Set used to search a Zipcode.
     *
     * @var stdClass
     */
    protected $data;

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
    public function findbyZipcode($zipcode)
    {
        $result = array_filter($this->data, function(\stdClass $value) use ($zipcode) {
            return $value->zipcode === $zipcode;
        });

        if (empty($result)) {
            return null;
        }

        return reset($result);
    }

    /**
     * Read Zipcode JSON Data.
     *
     * @return stdClass
     */
    public function getDataSet()
    {
        $zipcodes = file_get_contents(__DIR__.'/data/zipcodes.json');

        return json_decode($zipcodes);
    }
}
