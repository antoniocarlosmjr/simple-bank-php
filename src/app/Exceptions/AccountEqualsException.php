<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class AccountEqualsException extends Exception
{
    public function __construct(
        string $message = 'account origin and destination are same',
        int $code = Response::HTTP_UNPROCESSABLE_ENTITY
    ) {
        parent::__construct($message, $code);
    }
}
