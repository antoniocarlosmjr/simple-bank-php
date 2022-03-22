<?php

namespace App\Application\Services\Event;

use App\Application\Services\Event\Contracts\EventStrategy;
use App\Domain\Entities\Event\EventEntity;

class EventContext
{
    public function __construct(
        protected EventStrategy $eventStrategy
    ) {
    }

    public function create(EventEntity $eventEntity): array
    {
        return $this->eventStrategy->create($eventEntity);
    }
}
