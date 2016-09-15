<?php

namespace Wnx\SwissCantons;

use Exception;

class CantonManager
{
    /**
     * CantonSearch Instance.
     *
     * @var Wnx\SwissCantons\CantonSearch
     */
    protected $search;

    /**
     * ZipcodeSearch Instance.
     *
     * @var Wnx\SwissCantons\ZipcodeSearch
     */
    protected $zipcodeSearch;

    public function __construct()
    {
        $this->search = new CantonSearch();
        $this->zipcodeSearch = new ZipcodeSearch();
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

    /**
     * Get Canton by Zipcode.
     *
     * @param int $zipcode
     *
     * @throws Exception if not Canton was found
     *
     * @return Canton
     */
    public function getByZipcode($zipcode)
    {
        $result = $this->zipcodeSearch->findByZipcode($zipcode);

        if (is_null($result)) {
            throw new Exception("Couldn't find Canton for given Zipcode: {$zipcode}.");
        }

        return $this->getByAppreviation($result->canton);
    }
}
