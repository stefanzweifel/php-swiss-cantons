<?php declare(strict_types=1);

namespace Wnx\SwissCantons\Exceptions;

use Exception;
use Wnx\SwissCantons\Canton;

class InvalidLanguageException extends Exception
{
    public function __construct()
    {
        parent::__construct('The given language is not supported. Supported languages: '.implode(', ', Canton::AVAILABLE_LANGUAGES));
    }
}
