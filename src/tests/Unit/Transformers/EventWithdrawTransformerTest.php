<?php

namespace Tests\Unit\Transformers;

use App\Domain\Entities\Account\AccountEntity;
use App\Infra\Transformers\EventWithdrawTransformer;
use Faker\Factory;
use Tests\TestCase;

class EventWithdrawTransformerTest extends TestCase
{
    public function testSuccessTransformWithdraw()
    {
        $eventWithdrawTransformer = app(EventWithdrawTransformer::class);
        $accountEntity = new AccountEntity();
        $faker = Factory::create();

        $accountEntity->setId($faker->randomNumber());
        $accountEntity->setBalance($faker->randomNumber(2));
        $resultExpected = $this->generateExpected($accountEntity);
        $result = $eventWithdrawTransformer->transform($accountEntity);

        $this->assertEquals($resultExpected, $result);
    }

    private function generateExpected(AccountEntity $accountEntity): array
    {
        return [
            'origin' => [
                'id' => (string) $accountEntity->getId(),
                'balance' => $accountEntity->getBalance()
            ]
        ];
    }
}
