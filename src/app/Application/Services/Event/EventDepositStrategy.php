<?php

namespace App\Application\Services\Event;

use App\Application\Repositories\AccountRepositoryInterface;
use App\Application\Repositories\EventRepositoryInterface;
use App\Application\Services\Event\Contracts\EventStrategy;
use App\Domain\Entities\Event\EventEntity;
use App\Enumerators\EventStatusEnum;
use Exception;

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
     * @param EventEntity $entity
     * @return array
     * @throws Exception
     */
    public function create(EventEntity $entity): array
    {
        try {

            $entity = $this->eventRepository->create($entity);
            dd($entity);
            $entity->setType(EventStatusEnum::PROCESSING);
            $entity = $this->eventRepository->update($entity);

            $entity->setType(EventStatusEnum::COMPLETED);
        } catch (Exception $e) {
            $entity->setType(EventStatusEnum::CANCELED);
            $this->eventRepository->update($entity);
            throw $e;
        }

        // criar o event no banco
        // alterar o status para em andamento
        // verificar a existência do

        dd("teste");
        // se for deposit tem que verificar a existencia da conta de origem
        // TODO: Implement createEvent() method.
        // lembrar que aqui cria a conta também com saldo inicial caso a conta não exista
        return [];
    }
}
