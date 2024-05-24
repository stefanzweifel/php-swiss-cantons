<?php declare(strict_types=1);

namespace Wnx\SwissCantons;

use Wnx\SwissCantons\Exceptions\CantonNotFoundException;

class CantonManager
{
    protected CantonSearch $search;
    protected CitySearch $citySearch;

    public function __construct()
    {
        $this->search = new CantonSearch();
        $this->citySearch = new CitySearch();
    }

    /**
     * Get Canton by abbreviation.
     *
     * @throws CantonNotFoundException
     */
    public function getByAbbreviation(string $abbreviation): Canton
    {
        $result = $this->search->findByAbbreviation($abbreviation);

        if (is_null($result)) {
            throw CantonNotFoundException::notFoundForAbbreviation($abbreviation);
        }

        return $result;
    }

    /**
     * Get Canton by Name.
     *
     * @throws CantonNotFoundException
     */
    public function getByName(string $name): Canton
    {
        $result = $this->search->findByName($name);

        if (is_null($result)) {
            throw CantonNotFoundException::notFoundForName($name);
        }

        return $result;
    }

    /**
     * Get possible Cantons with a Zipcode.
     *
     * @param int $zipcode
     * @return Canton[]
     * @throws CantonNotFoundException
     */
    public function getByZipcode(int $zipcode): array
    {
        $cities = $this->citySearch->findByZipcode($zipcode);

        // Get cantons abbreviations
        $cantonAbbreviations = array_column($cities, 'canton');

        // Remove duplicates
        $cantonAbbreviations = array_unique($cantonAbbreviations);

        // Search cantons by abbreviation
        $cantons = array_map(fn (string $abbreviation) => $this->search->findByAbbreviation($abbreviation), $cantonAbbreviations);

        // Call 'array_filter' without callback to remove null values
        $cantons = array_filter($cantons);

        if (empty($cantons)) {
            throw CantonNotFoundException::notFoundForZipcode($zipcode);
        }

        return $cantons;
    }

}
