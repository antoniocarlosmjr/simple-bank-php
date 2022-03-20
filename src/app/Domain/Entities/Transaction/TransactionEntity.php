<?php

namespace App\Domain\Entities\Transaction;

use App\Domain\Entities\DefaultEntity;
use DateTime;

class TransactionEntity extends DefaultEntity
{
    protected int $id;
    protected string $type;
    protected string $status;
    protected int $accountId;
    protected Datetime $createdAt;
    protected DateTime $updatedAt;
}
