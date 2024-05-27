<?php declare(strict_types=1);

namespace Wnx\SwissCantons\Exceptions;

use Exception;

class NotUniqueCantonException extends Exception
{
    public static function notUniqueForZipcode(int $zipcode): self
    {
        /** @phpstan-ignore-next-line */
        return new static("Couldn't find an unique Canton for given zipcode: {$zipcode}");
    }

    public static function notUniqueForZipcodeAndCity(int $zipcode, string $city): self
    {
        /** @phpstan-ignore-next-line */
        return new static("Couldn't find an unique Canton for given zipcode and city name: {$zipcode}, {$city}");
    }
}
