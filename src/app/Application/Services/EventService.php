<?php

namespace App\Application\Services;

use App\Application\Repositories\AccountRepositoryInterface;
use App\Application\Repositories\EventRepositoryInterface;
use App\Domain\Entities\Event\EventEntity;

class EventService
{
    public function __construct(
        protected EventRepositoryInterface $eventRepository,
        protected AccountRepositoryInterface $accountRepository
    ) {
    }

    public function createEvent(EventEntity $eventEntity): array
    {
        // verificar o tipo de evento (transfer, deposit e saque)
        // se for saque tem que verificar a existência da conta destino
        // se for deposit tem que verificar a existencia da conta de origem
        // se for transfer verificar a existencia de duas contas

        return [];
    }

    private function deposit()
    {
        // lembrar que aqui cria a conta também com saldo inicial caso a conta não exista
    }

    private function withdraw()
    {

    }

    private function transfer()
    {

    }
}
