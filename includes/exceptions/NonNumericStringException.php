<?php

namespace exceptions;

use Exception;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
use Throwable;

class NonNumericStringException extends Exception
{
    protected $code = 400;

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        http_response_code($code);
        parent::__construct($message, $code, $previous);
    }
}
