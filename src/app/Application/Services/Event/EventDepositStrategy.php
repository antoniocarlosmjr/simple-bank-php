<?php

namespace App\Application\Services\Event;

use App\Application\Repositories\AccountRepositoryInterface;
use App\Application\Repositories\EventRepositoryInterface;
use App\Application\Services\Account\AccountService;
use App\Application\Services\Event\Contracts\EventStrategy;
use App\Domain\Entities\Account\AccountEntity;
use App\Domain\Entities\Event\EventEntity;
use App\Enumerators\EventStatusEnum;
use App\Infra\Transformers\EventDepositTransformer;
use Illuminate\Support\Facades\DB;
use Throwable;

class EventDepositStrategy implements EventStrategy
{
    public function __construct(
        protected AccountRepositoryInterface $accountRepository,
        protected EventRepositoryInterface $eventRepository
    ) {
    }

    /**
     * Rule of business of to do deposit in a account. When account does not exist we create a new.
     *
     * @param EventEntity $eventEntity
     * @return array
     * @throws Throwable
     */
    public function create(EventEntity $eventEntity): array
    {
        try {
            DB::beginTransaction();
            $eventEntity = $this->eventRepository->create($eventEntity);
            $eventEntity->setStatus(EventStatusEnum::PROCESSING);
            $eventEntity = $this->eventRepository->update($eventEntity);

            $accountEntity = new AccountEntity();
            $accountEntity->setId($eventEntity->getAccountIdDestination());
            $accountExist = $this->accountRepository->getAccountById($accountEntity);

            $accountService = new AccountService($this->accountRepository);
            if (!$accountExist) {
                $accountEntity = $accountService->createInicialAccount($accountEntity);
            }

            $accountEntity = $accountService->increaseMoney($accountEntity, $eventEntity->getAmount());
            $eventEntity->setType(EventStatusEnum::COMPLETED);
            $eventEntity = $this->eventRepository->update($eventEntity);
            DB::commit();

            return app(EventDepositTransformer::class)->transform($accountEntity);
        } catch (Throwable $e) {
            DB::rollBack();
            $eventEntity->setStatus(EventStatusEnum::CANCELED);
            $this->eventRepository->update($eventEntity);
            throw $e;
        }
    }
}
