<?php

namespace Wnx\SwissCantons;

use Exception;

class Canton
{
    /**
     * Abbreviation for given Canton.
     *
     * @var string
     */
    protected $appreviation;

    /**
     * Array of available Names for given Canton.
     *
     * @var array
     */
    protected $names = [];

    /**
     * Default Language used.
     *
     * @var string
     */
    protected $displayLanguage = 'en';

    /**
     * Array of supported Languages.
     *
     * @var array
     */
    protected $availableLanguages = ['de', 'fr', 'it', 'en', 'rm'];

    public function __construct(\stdClass $data)
    {
        $this->setAbbreviation($data->abbreviation);
        $this->setNames((array) $data->name);
    }

    /**
     * Set the abbreviation for given Canton.
     *
     * @param string $abbreviation
     */
    public function setAbbreviation($abbreviation)
    {
        return $this->appreviation = $abbreviation;
    }

    /**
     * Return Abbreviation for Canton.
     *
     * @return string
     */
    public function getAbbreviation()
    {
        return $this->appreviation;
    }

    /**
     * Add Name Array to Property.
     *
     * @param array $name
     */
    public function setNames(array $name)
    {
        return $this->names = $name;
    }

    /**
     * Return Display Name for given Language.
     *
     * @return string
     */
    public function getName()
    {
        return $this->names[$this->getLanguage()];
    }

    /**
     * It Returns the Raw Name Array.
     *
     * @return array
     */
    public function getNamesArray()
    {
        return $this->names;
    }

    /**
     * Set Language used to Display Canton Name.
     *
     * @param string $language
     *
     * @throws Exception Throws Exception if a not supported language string was provided
     */
    public function setLanguage($language)
    {
        $language = strtolower($language);

        if (!in_array($language, $this->availableLanguages)) {
            throw new Exception('Invalid Language Provided. Supported languages: '.implode(',', $this->availableLanguages));
        }

        $this->displayLanguage = $language;

        return $this;
    }

    /**
     * Return Language used to Display Canton Name.
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->displayLanguage;
    }
}
