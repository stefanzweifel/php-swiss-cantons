<?php

namespace Wnx\SwissCantons;

use Exception;

class CantonManager
{
    /**
     * CantonSearch Instance.
     *
     * @var Wnx\SwissCantons\CantonSerach
     */
    protected $search;

    public function __construct()
    {
        $this->search = new CantonSearch();
    }

    /**
     * Get Canton by abbreviation.
     *
     * @param string $abbreviation
     *
     * @throws Exception Throws Exception if no Canton was found
     *
     * @return Canton
     */
    public function getByAppreviation($abbreviation)
    {
        $result = $this->search->findByAppreviation($abbreviation);

        if (is_null($result)) {
            throw new Exception("Couldn't find Canton for given appreviation.");
        }

        return new Canton($result);
    }

    /**
     * Get Canton by Name.
     *
     * @param string $name
     *
     * @throws Exception Throws Exception if not Canton was found
     *
     * @return Canton
     */
    public function getByName($name)
    {
        $result = $this->search->findByName($name);

        if (is_null($result)) {
            throw new Exception("Couldn't find Canton for given Name {$name}.");
        }

        return new Canton($result);
    }
}
