<?php

namespace App\Application\Services\Event;

use App\Application\Repositories\AccountRepositoryInterface;
use App\Application\Repositories\EventRepositoryInterface;
use App\Application\Services\Account\AccountService;
use App\Application\Services\Event\Contracts\EventStrategy;
use App\Domain\Entities\Account\AccountEntity;
use App\Domain\Entities\Event\EventEntity;
use App\Enumerators\EventStatusEnum;
use App\Exceptions\AccountNotFoundException;
use App\Exceptions\BalanceUnavailableForWithdrawalException;
use App\Infra\Transformers\EventWithdrawTransformer;
use Throwable;

class EventWithdrawStrategy implements EventStrategy
{
    public function __construct(
        protected AccountRepositoryInterface $accountRepository,
        protected EventRepositoryInterface $eventRepository
    ) {
    }

    /**
     * Rule of business of to do a withdraw in a account.
     *
     * @param EventEntity $eventEntity
     * @return array
     * @throws AccountNotFoundException
     * @throws Throwable
     * @throws BalanceUnavailableForWithdrawalException
     */
    public function create(EventEntity $eventEntity): array
    {
        try {
            $eventEntity = $this->eventRepository->create($eventEntity);
            $eventEntity->setStatus(EventStatusEnum::PROCESSING);
            $eventEntity = $this->eventRepository->update($eventEntity);

            $accountEntity = new AccountEntity();
            $accountEntity->setId($eventEntity->getAccountIdOrigin());
            $accountExist = $this->accountRepository->getAccountById($accountEntity);

            if (!$accountExist) {
                throw new AccountNotFoundException();
            }

            $accountService = new AccountService($this->accountRepository);
            $accountEntity = $accountService->decreaseMoney($accountEntity, $eventEntity->getAmount());
            $eventEntity->setStatus(EventStatusEnum::COMPLETED);
            $eventEntity = $this->eventRepository->update($eventEntity);

            return app(EventWithdrawTransformer::class)->transform($accountEntity);
        } catch (Throwable $e) {
            $eventEntity->setStatus(EventStatusEnum::CANCELED);
            $this->eventRepository->update($eventEntity);
            throw $e;
        }
    }
}
