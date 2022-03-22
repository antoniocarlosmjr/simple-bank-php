<?php

namespace App\Application\Services\Event;

use App\Application\Repositories\AccountRepositoryInterface;
use App\Application\Repositories\EventRepositoryInterface;
use App\Domain\Entities\Event\EventEntity;
use App\Enumerators\EventTypesEnum;
use App\Exceptions\EventTypeInvalidException;

class EventService
{
    public function __construct(
        protected EventRepositoryInterface $eventRepository,
        protected AccountRepositoryInterface $accountRepository,
    ) {
    }

    /**
     * Verify of type of event and call a specific strategy.
     *
     * @param EventEntity $eventEntity
     * @return array
     * @throws EventTypeInvalidException
     */
    public function createEvent(EventEntity $eventEntity): array
    {
        $eventType = match ($eventEntity->getType()) {
            EventTypesEnum::DEPOSIT => new EventDepositStrategy($this->accountRepository, $this->eventRepository),
            EventTypesEnum::TRANSFER => new EventTransferStrategy($this->accountRepository, $this->eventRepository),
            EventTypesEnum::WITHDRAW => new EventWithdrawStrategy($this->accountRepository, $this->eventRepository),
            default => throw new EventTypeInvalidException(),
        };

        $eventContext = new EventContext($eventType);
        return $eventContext->create($eventEntity);
    }
}
