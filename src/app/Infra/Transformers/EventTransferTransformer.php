<?php

namespace App\Infra\Transformers;

use App\Domain\Entities\Account\AccountEntity;

class EventTransferTransformer
{
    public function transform(AccountEntity $accountOriginEntity, AccountEntity $accountDestinationEntity): array
    {
        return [
            'origin' => [
                'id' => (string) $accountOriginEntity->getId(),
                'balance' => $accountOriginEntity->getBalance()
            ],
            'destination' => [
                'id' => (string) $accountDestinationEntity->getId(),
                'balance' => $accountDestinationEntity->getBalance()
            ]
        ];
    }
}
