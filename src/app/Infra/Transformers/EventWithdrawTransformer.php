<?php

namespace App\Infra\Transformers;

use App\Domain\Entities\Account\AccountEntity;

class EventWithdrawTransformer
{
    public function transform(AccountEntity $accountEntity): array
    {
        return [
            'origin' => [
                'id' => (string) $accountEntity->getId(),
                'balance' => $accountEntity->getBalance()
            ]
        ];
    }
}
