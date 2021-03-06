<?php

namespace App\Infra\Transformers;

use App\Domain\Entities\Account\AccountEntity;

class EventDepositTransformer
{
    public function transform(AccountEntity $accountEntity): array
    {
        return [
            'destination' => [
                'id' => (string) $accountEntity->getId(),
                'balance' => $accountEntity->getBalance()
            ]
        ];
    }
}
