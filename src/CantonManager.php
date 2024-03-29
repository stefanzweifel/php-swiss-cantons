<?php declare(strict_types=1);

namespace Wnx\SwissCantons;

use Wnx\SwissCantons\Exceptions\CantonException;

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
     * @throws CantonException
     */
    public function getByAbbreviation(string $abbreviation): Canton
    {
        $result = $this->search->findByAbbreviation($abbreviation);

        if (is_null($result)) {
            throw CantonException::notFoundForAbbreviation($abbreviation);
        }

        return $result;
    }

    /**
     * Get Canton by Name.
     *
     * @throws CantonException
     */
    public function getByName(string $name): Canton
    {
        $result = $this->search->findByName($name);

        if (is_null($result)) {
            throw CantonException::notFoundForName($name);
        }

        return $result;
    }

    /**
     * Get Canton by Zipcode.
     *
     * @throws CantonException
     */
    public function getByZipcode(int $zipcode): Canton
    {
        $result = $this->zipcodeSearch->findByZipcode($zipcode);

        if (is_null($result)) {
            throw CantonException::notFoundForZipcode($zipcode);
        }

        return $this->getByAbbreviation($result['canton']);
    }
}
