<?php declare(strict_types=1);

namespace Wnx\SwissCantons;

use Exception;
use Wnx\SwissCantons\Exceptions\InvalidLanguageException;

class Canton
{
    public const LANG_GERMAN = 'de';

    public const LANG_FRENCH = 'fr';

    public const LANG_ITALIAN = 'it';

    public const LANG_ENGLISH = 'en';

    public const LANG_ROMANSH = 'rm';

    public const AVAILABLE_LANGUAGES = [
        self::LANG_GERMAN,
        self::LANG_FRENCH,
        self::LANG_ITALIAN,
        self::LANG_ENGLISH,
        self::LANG_ROMANSH,
    ];

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
    protected string $displayLanguage = self::LANG_ENGLISH;

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
     * @throws \Wnx\SwissCantons\Exceptions\InvalidLanguageException
     */
    public function setLanguage(string $language): Canton
    {
        $language = strtolower($language);

        if (in_array($language, self::AVAILABLE_LANGUAGES) === false) {
            throw new InvalidLanguageException;
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
