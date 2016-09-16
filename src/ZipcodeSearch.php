<?php

namespace Wnx\SwissCantons;

use Illuminate\Support\Collection;

class ZipcodeSearch
{
    /**
     * Data Set used to search a Zipcode.
     *
     * @var Collection
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
        return $this->data->first(function ($key, $value) use ($zipcode) {
            return $value->zipcode === $zipcode;
        });
    }

    /**
     * Read Zipcode JSON Data.
     *
     * @return Collection
     */
    public function getDataSet()
    {
        $zipcodes = file_get_contents(__DIR__.'/data/zipcodes.json');

        return new Collection(json_decode($zipcodes));
    }
}
