<?php

namespace App\Application\Services\Event;

use App\Application\Services\Event\Contracts\EventStrategy;
use App\Domain\Entities\Event\EventEntity;

class EventTransferStrategy implements EventStrategy
{
    public function create(EventEntity $entity): array
    {
        // TODO: Implement create() method.
        return [];
        // se for transfer verificar a existencia de duas contas
        // e verificar se a conta de origem tem dinheiro
    }
}
