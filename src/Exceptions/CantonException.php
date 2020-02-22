<?php declare(strict_types=1);

namespace Wnx\SwissCantons\Exceptions;

use Exception;

class CantonException extends Exception
{
    public static function notFoundForAbbreviation(string $abbreviation): self
    {
        return new static("Couldn't find Canton for given abbreviation: {$abbreviation}");
    }

    public static function notFoundForName(string $name): self
    {
        return new static("Couldn't find Canton for given name: {$name}");
    }

    public static function notFoundForZipcode(int $zipcode): self
    {
        return new static("Couldn't find Canton for given zipcode: {$zipcode}");
    }
}
