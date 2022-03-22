<?php

namespace App\Application\Services\Event;

use App\Application\Services\Event\Contracts\EventStrategy;
use App\Domain\Entities\Event\EventEntity;

class EventWithdrawStrategy implements EventStrategy
{
    public function create(EventEntity $entity): array
    {
        // TODO: Implement create() method.

        // se for saque tem que verificar a existência da conta destino
        return [];
    }
}
