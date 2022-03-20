<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class AccountNotFoundException extends \Exception
{
    public function __construct(
        string $message = 'account not found',
        int $code = Response::HTTP_NOT_FOUND
    ) {
        parent::__construct($message, $code);
    }
}
