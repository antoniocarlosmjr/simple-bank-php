<?php

namespace Tests\Unit\Transformers;

use App\Domain\Entities\Account\AccountEntity;
use App\Infra\Transformers\EventTransferTransformer;
use Faker\Factory;
use Tests\TestCase;

class EventTransferTransformerTest extends TestCase
{
    public function testSuccessTransformWithdraw()
    {
        $transferTransformer = app(EventTransferTransformer::class);
        $faker = Factory::create();

        $accountEntityOrigin = new AccountEntity();
        $accountEntityOrigin->setId($faker->randomNumber());
        $accountEntityOrigin->setBalance($faker->randomNumber(2));

        $accountEntityDest = new AccountEntity();
        $accountEntityDest->setId($faker->randomNumber());
        $accountEntityDest->setBalance($faker->randomNumber(2));

        $resultExpected = $this->generateExpected($accountEntityOrigin, $accountEntityDest);
        $result = $transferTransformer->transform($accountEntityOrigin, $accountEntityDest);

        $this->assertEquals($resultExpected, $result);
    }

    private function generateExpected(AccountEntity $accountEntityOrigin, AccountEntity $accountEntityDest): array
    {
        return [
            'origin' => [
                'id' => (string) $accountEntityOrigin->getId(),
                'balance' => $accountEntityOrigin->getBalance()
            ],
            'destination' => [
                'id' => (string) $accountEntityDest->getId(),
                'balance' => $accountEntityDest->getBalance()
            ]
        ];
    }
}
