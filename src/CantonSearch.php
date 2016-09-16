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

            // Transform a dump array to a smart collection
            $itemNames = (array) $item->name;

            // Return the current Canton, if it contains the name
            // Copied from illuminate/support
            // https://github.com/illuminate/support/blob/master/Collection.php#L168-L172
            if (!is_string($name) && is_callable($name)) {
                return !is_null(reset($name));
            }

            return in_array($name, $itemNames);
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
