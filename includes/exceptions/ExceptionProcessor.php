<?php

namespace exceptions;

use Throwable;

class ExceptionProcessor
{
    /**
     * @param Throwable $exception
     */
    public function __construct(Throwable $exception)
    {
        $code = $exception->getCode();
        http_response_code($code);
        echo $exception->getMessage();
        exit;
    }
}
