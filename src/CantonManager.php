<?php

namespace Wnx\SwissCantons;

use Exception;

class CantonManager
{
    protected CantonSearch $search;

    protected ZipcodeSearch $zipcodeSearch;

    public function __construct()
    {
        $this->search = new CantonSearch();
        $this->zipcodeSearch = new ZipcodeSearch();
    }

    /**
     * Get Canton by abbreviation.
     *
     * @throws Exception Throws Exception if no Canton was found
     */
    public function getByAbbreviation(string $abbreviation): Canton
    {
        $result = $this->search->findByAbbreviation($abbreviation);

        if (is_null($result)) {
            throw new Exception("Couldn't find Canton for given abbreviation.");
        }

        return $result;
    }

    /**
     * Get Canton by Name.
     *
     * @throws Exception Throws Exception if not Canton was found
     */
    public function getByName(string $name): Canton
    {
        $result = $this->search->findByName($name);

        if (is_null($result)) {
            throw new Exception("Couldn't find Canton for given Name {$name}.");
        }

        return $result;
    }

    /**
     * Get Canton by Zipcode.
     *
     * @throws Exception if not Canton was found
     */
    public function getByZipcode(int $zipcode): Canton
    {
        $result = $this->zipcodeSearch->findByZipcode($zipcode);

        if (is_null($result)) {
            throw new Exception("Couldn't find Canton for given Zipcode: {$zipcode}.");
        }

        return $this->getByAbbreviation($result['canton']);
    }
}
