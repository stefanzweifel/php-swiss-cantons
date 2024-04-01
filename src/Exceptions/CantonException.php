<?php declare(strict_types=1);

namespace Wnx\SwissCantons\Exceptions;

use Exception;

class CantonException extends Exception
{
    public static function notFoundForAbbreviation(string $abbreviation): self
    {
        /** @phpstan-ignore-next-line */
        return new static("Couldn't find Canton for given abbreviation: {$abbreviation}");
    }

    public static function notFoundForName(string $name): self
    {
        /** @phpstan-ignore-next-line */
        return new static("Couldn't find Canton for given name: {$name}");
    }

    public static function notFoundForZipcode(int $zipcode): self
    {
        /** @phpstan-ignore-next-line */
        return new static("Couldn't find Canton for given zipcode: {$zipcode}");
    }
}
