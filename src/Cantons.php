<?php declare(strict_types=1);

namespace Wnx\SwissCantons;

class Cantons
{
    protected array $cantons;

    public function __construct()
    {
        $this->cantons = json_decode(file_get_contents(__DIR__.'/data/cantons.json'), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * Return all Cantons.
     *
     * @return array<Canton>
     */
    public function getAll(): array
    {
        return array_map(fn ($canton) => new Canton($canton), $this->cantons);
    }

    /**
     * Return all Cantons as a one dimensional array of abbreviation and names.
     *
     * @throws Exceptions\InvalidLanguageException
     */
    public function getAllAsArray(string $defaultLanguage = Canton::LANG_ENGLISH): array
    {
        $cantons = $this->getAll();
        $resultArray = [];

        /** @var Canton $canton */
        foreach ($cantons as $canton) {
            $canton->setLanguage($defaultLanguage);
            $resultArray[$canton->getAbbreviation()] = $canton->getName();
        }

        return $resultArray;
    }
}
