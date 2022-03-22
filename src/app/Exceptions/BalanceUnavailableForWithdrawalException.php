<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class BalanceUnavailableForWithdrawalException extends Exception
{
    public function __construct(
        string $message = 'unavailable balance for withdrawal',
        int $code = Response::HTTP_UNPROCESSABLE_ENTITY
    ) {
        parent::__construct($message, $code);
    }
}
