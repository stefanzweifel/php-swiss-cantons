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
        $this->data = $this->getDataSet();
    }

    /**
     * Find Canton by Abbreviation.
     *
     * @param string $abbreviation
     *
     * @return mixed Returns an object or null, if no canton was found
     */
    public function findByAppreviation($abbreviation)
    {
        $result = array_filter($this->data, function (\stdClass $value) use ($abbreviation) {
            return $value->abbreviation === $abbreviation;
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
        $result = array_filter($this->data, function ($item) use ($name) {
            return in_array($name, (array) $item->name);
        });

        if (empty($result)) {
            return;
        }

        return reset($result);
    }

    /**
     * Read JSON Data.
     *
     * @return stdClass
     */
    public function getDataSet()
    {
        $cantons = file_get_contents(__DIR__.'/data/cantons.json');

        return json_decode($cantons);
    }
}
