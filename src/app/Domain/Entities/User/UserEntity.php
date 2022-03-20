<?php

namespace App\Domain\Entities\User;

use App\Domain\Entities\DefaultEntity;
use DateTime;

class UserEntity extends DefaultEntity
{
    protected int $id;
    protected string $name;
    protected bool $active;
    protected int $accountId;
    protected Datetime $createdAt;
    protected DateTime $updatedAt;
}
