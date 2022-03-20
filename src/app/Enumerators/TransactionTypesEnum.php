<?php

namespace App\Enumerators;

class TransactionTypesEnum extends BaseEnum
{
    public const DEPOSIT = 'deposit';
    public const WITHDRAW = 'withdraw';
    public const TRANSFER = 'transfer';
}
