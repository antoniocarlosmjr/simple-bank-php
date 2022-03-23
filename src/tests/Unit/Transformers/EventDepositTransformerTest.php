<?php

namespace Tests\Unit\Transformers;

use App\Domain\Entities\Account\AccountEntity;
use App\Infra\Transformers\EventDepositTransformer;
use Faker\Factory;
use Tests\TestCase;

class EventDepositTransformerTest extends TestCase
{
    public function testSuccessTransformWithdraw()
    {
        $depositTransformer = app(EventDepositTransformer::class);
        $accountEntity = new AccountEntity();
        $faker = Factory::create();

        $accountEntity->setId($faker->randomNumber());
        $accountEntity->setBalance($faker->randomNumber(2));
        $resultExpected = $this->generateExpected($accountEntity);
        $result = $depositTransformer->transform($accountEntity);

        $this->assertEquals($resultExpected, $result);
    }

    private function generateExpected(AccountEntity $accountEntity): array
    {
        return [
            'destination' => [
                'id' => (string) $accountEntity->getId(),
                'balance' => $accountEntity->getBalance()
            ]
        ];
    }
}
