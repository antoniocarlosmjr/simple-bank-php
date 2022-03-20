<?php

namespace App\Enumerators;

class TransactionStatusEnum
{
    public const STARTED = 'started';
    public const PROCESSING = 'processing';
    public const CANCELED = 'canceled';
    public const COMPLETED = 'completed';
    public const NOT_AUTHORIZED = 'not_authorized';
}
