<?php

namespace App\Domain\Entities\Event;

use App\Domain\Entities\Account\AccountEntity;
use App\Domain\Entities\DefaultEntity;
use DateTime;

class EventEntity extends DefaultEntity
{
    protected int $id;
    protected string $type;
    protected string $status;
    protected ?int $accountIdOrigin;
    protected ?int $accountIdDestination;
    protected float $amount;
    protected Datetime $createdAt;
    protected DateTime $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): EventEntity
    {
        $this->id = $id;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): EventEntity
    {
        $this->type = $type;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $newStatus): EventEntity
    {
        $this->status = $newStatus;
        return $this;
    }

    public function getOrigin(): int
    {
        return $this->accountIdOrigin;
    }

    public function setOrigin(?int $origin): EventEntity
    {
        $this->accountIdOrigin = $origin;
        return $this;
    }

    public function getDestination(): int
    {
        return $this->accountIdDestination;
    }

    public function setDestination(?int $accountDestination): EventEntity
    {
        $this->accountIdDestination = $accountDestination;
        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $newAmount): EventEntity
    {
        $this->amount = $newAmount;
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
