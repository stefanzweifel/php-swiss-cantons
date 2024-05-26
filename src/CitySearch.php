<?php declare(strict_types=1);

namespace Wnx\SwissCantons;

/**
 * @phpstan-type City array{canton: string, city: string, zipcode: int}
 */
class CitySearch
{
    /** @var City[] */
    protected array $dataset;

    public function __construct()
    {
        $this->dataset = $this->loadDataset();
    }

    /**
     * Find Data Set for a City by Zipcode.
     *
     * @return City[]
     */
    public function findByZipcode(int $zipcode): array
    {
        return array_values(array_filter($this->dataset, fn (array $city) => $city['zipcode'] === $zipcode));
    }

    /**
     * @return City[]
     * @throws \JsonException
     */
    private function loadDataset(): array
    {
        return json_decode(file_get_contents(__DIR__.'/data/cities.json'), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @return City[]
     */
    public function getDataSet(): array
    {
        return $this->dataset;
    }
}
