<?php

namespace Wnx\SwissCantons;

use Illuminate\Support\Collection;

class CantonSearch
{
    /**
     * Data Set used to search a Canton
     * @var Collection
     */
    protected $data;

    public function __construct()
    {
        $this->data = $this->getDataSet();
    }

    /**
     * Find Canton by Abbreviation
     * @param  string $abbreviation
     * @return mixed                Returns an object or null, if no canton was found
     */
    public function findByAppreviation($abbreviation)
    {
        return $this->data->first(function($key, $value) use ($abbreviation) {
            return $value->abbreviation === $abbreviation;
        });
    }

    /**
     * Find Canton by Name
     * @param  string $name
     * @return mixed       Returns an object or null, if no canton was found
     */
    public function findByName($name)
    {
        return $this->data->filter(function($item) use ($name) {

            // Transform a dump array to a smart collection
            $itemNames = new Collection($item->name);

            // Return the current Canton, if it contains the name
            return $itemNames->contains($name);
        })->first();
    }

    /**
     * Read JSON Data
     * @return Collection
     */
    public function getDataSet()
    {
        $cantons = file_get_contents(__DIR__ . "/data/cantons.json");

        return new Collection(json_decode($cantons));
    }

}