<?php

namespace App\Domain\Entities\Account;

use App\Domain\Entities\DefaultEntity;
use DateTime;

class AccountEntity extends DefaultEntity
{
    protected int $id;
    protected string $type;
    protected bool $active;
    protected float $balance;
    protected Datetime $createdAt;
    protected ?DateTime $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): AccountEntity
    {
        $this->id = $id;
        return $this;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): AccountEntity
    {
        $this->active = $active;
        return $this;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function setBalance(float $newBalance): AccountEntity
    {
        $this->balance = $newBalance;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $newType): AccountEntity
    {
        $this->type = $newType;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $newDate): AccountEntity
    {
        $this->createdAt = $newDate;
        return $this;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): AccountEntity
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
