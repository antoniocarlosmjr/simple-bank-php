<?php

namespace App\Application\Services\Event;

use App\Application\Repositories\AccountRepositoryInterface;
use App\Application\Repositories\EventRepositoryInterface;
use App\Application\Services\Account\AccountService;
use App\Application\Services\Event\Contracts\EventStrategy;
use App\Domain\Entities\Account\AccountEntity;
use App\Domain\Entities\Event\EventEntity;
use App\Enumerators\EventStatusEnum;
use App\Exceptions\AccountEqualsException;
use App\Exceptions\AccountNotFoundException;
use App\Infra\Transformers\EventTransferTransformer;
use Illuminate\Support\Facades\DB;
use Throwable;

class EventTransferStrategy implements EventStrategy
{
    public function __construct(
        protected AccountRepositoryInterface $accountRepository,
        protected EventRepositoryInterface $eventRepository
    ) {
    }

    /**
     * Rule of business of to do transfer money between accounts.
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

            if ($eventEntity->getAccountIdOrigin() == $eventEntity->getAccountIdDestination()) {
                throw new AccountEqualsException();
            }

            $originAccount = $this->verifyAccount($eventEntity->getAccountIdOrigin());
            $destinationAccount = $this->verifyAccount($eventEntity->getAccountIdDestination());

            $accountService = new AccountService($this->accountRepository);
            $accountOriginEntity = $accountService->decreaseMoney($originAccount, $eventEntity->getAmount());
            $accountDestinationEntity = $accountService->increaseMoney($destinationAccount, $eventEntity->getAmount());

            $eventEntity->setType(EventStatusEnum::COMPLETED);
            $eventEntity = $this->eventRepository->update($eventEntity);
            DB::commit();

            return app(EventTransferTransformer::class)->transform($accountOriginEntity, $accountDestinationEntity);
        } catch (Throwable $e) {
            DB::rollBack();
            $eventEntity->setStatus(EventStatusEnum::CANCELED);
            $this->eventRepository->update($eventEntity);
            throw $e;
        }
    }

    /**
     * Verify if account exist and return if exists.
     *
     * @param int $accountId
     * @return AccountEntity
     * @throws AccountNotFoundException
     */
    private function verifyAccount(int $accountId): AccountEntity
    {
        $accountEntity = new AccountEntity();
        $accountEntity->setId($accountId);
        $accountExist = $this->accountRepository->getAccountById($accountEntity);

        if ($accountExist) {
            return $accountExist;
        }

        throw new AccountNotFoundException("account {$accountId} not found");
    }
}
