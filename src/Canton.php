<?php

namespace Wnx\SwissCantons;

use stdClass;
use Exception;

class Canton
{
    /**
     * Abbreviation for given Canton.
     */
    protected string $abbreviation;

    /**
     * Array of available Names for given Canton.
     */
    protected array $names = [];

    /**
     * Default Language used.
     */
    protected string $displayLanguage = 'en';

    /**
     * Array of supported Languages.
     */
    protected array $availableLanguages = ['de', 'fr', 'it', 'en', 'rm'];

    public function __construct(array $data)
    {
        $this->setAbbreviation($data['abbreviation']);
        $this->setNames($data['name']);
    }

    public function setAbbreviation(string $abbreviation): string
    {
        return $this->abbreviation = $abbreviation;
    }

    public function getAbbreviation(): string
    {
        return $this->abbreviation;
    }

    public function setNames(array $names): array
    {
        return $this->names = $names;
    }

    /**
     * Return Display Name for given Language.
     */
    public function getName(): string
    {
        return $this->names[$this->getLanguage()];
    }

    /**
     * It Returns the Raw Name Array.
     */
    public function getNamesArray(): array
    {
        return $this->names;
    }

    /**
     * Set Language used to Display Canton Name.
     *
     * @throws Exception Throws Exception if a not supported language string was provided
     */
    public function setLanguage(string $language): Canton
    {
        $language = strtolower($language);

        if (in_array($language, $this->availableLanguages) === false) {
            throw new Exception('Invalid Language Provided. Supported languages: '.implode(',', $this->availableLanguages));
        }

        $this->displayLanguage = $language;

        return $this;
    }

    /**
     * Return Language used to Display Canton Name.
     */
    public function getLanguage(): string
    {
        return $this->displayLanguage;
    }
}
