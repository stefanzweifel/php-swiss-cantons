<?php

namespace Wnx\SwissCantons;

use Illuminate\Support\Collection;
use Exception;

class SwissCantons
{
    /**
     * Array of supported Languages
     * @var array
     */
    protected $availableLanguages = ['de', 'fr', 'it', 'en', 'rm'];

    /**
     * Default Language used
     * @var string
     */
    protected $language = 'en';

    /**
     * Set Language for Output
     * @param string $language
     */
    public function setLanguage($language)
    {
        if (! in_array($language, $this->availableLanguages)) {
            throw new Exception("Invalid Language Provided.");
        }

        return $this->language = $language;
    }

    /**
     * Return set Language
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    public function getByAppreviation($abbreviation)
    {
        $cantons = $this->getData();
        $result  = $this->searchByAppreviation($cantons, $abbreviation);

        if ($result->count() !== 1) {
            throw new Exception("Couldn't find Canton for appreviation");
        }

        return $result->first();
    }

    public function getByName($name)
    {
        $cantons = $this->getData();
        $result  = $this->searchByName($cantons, $name);

        if ($result->count() !== 1) {
            throw new Exception("Couldn't find Canton for given Name {$name}");
        }

        return $result->first();
    }

    // -----------

    public function searchByName($cantons, $name)
    {
        return $cantons->filter(function($item) use ($name) {
            $itemNames = new Collection($item->name);
            return $itemNames->contains($name);
        });
    }

    public function searchByAppreviation($cantons, $abbreviation)
    {
        return $cantons->where('abbreviation', $abbreviation);
    }

    /**
     * Read JSON Data
     * @return Collection
     */
    public function getData()
    {
        $cantons = file_get_contents(__DIR__ . "/data/cantons.json");
        $cantons = json_decode($cantons);

        return new Collection($cantons);
    }
}
