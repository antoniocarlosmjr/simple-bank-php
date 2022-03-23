<?php

namespace Tests\Unit\Services;

use App\Application\Services\Event\EventDepositStrategy;
use App\Application\Services\Event\EventService;
use App\Application\Services\Event\EventTransferStrategy;
use App\Application\Services\Event\EventWithdrawStrategy;
use App\Domain\Entities\Account\AccountEntity;
use App\Domain\Entities\Event\EventEntity;
use App\Enumerators\EventStatusEnum;
use App\Enumerators\EventTypesEnum;
use App\Exceptions\AccountNotFoundException;
use Faker\Factory;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Mockery;
use Tests\TestCase;

class EventServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreateEventDeposit()
    {
        $valueDeposit = 10;
        $accountDestination = $this->createAccountExample(2, $valueDeposit);
        $eventExample = $this->createEventExample(EventTypesEnum::DEPOSIT, 10, null, 2);

        $mockEventRepository = Mockery::mock(EventDepositStrategy::class)
            ->shouldReceive('create')
            ->andReturn($eventExample);
        $this->app->instance(EventDepositStrategy::class, $mockEventRepository);

        $service = $this->app->make(EventService::class);
        $result = $service->createEvent($eventExample);

        $this->assertEquals($accountDestination->getBalance(), $result['destination']['balance']);
    }

    public function testCreateEventWithdrawExceptionAccountNotFound()
    {
        $eventExample = $this->createEventExample(EventTypesEnum::WITHDRAW, 10, 1, null);
        $mockEventRepository = Mockery::mock(EventWithdrawStrategy::class)
            ->shouldReceive('create')
            ->andReturn($eventExample);
        $this->app->instance(EventWithdrawStrategy::class, $mockEventRepository);

        $service = $this->app->make(EventService::class);
        $this->expectException(AccountNotFoundException::class);
        $service->createEvent($eventExample);

    }

    public function testCreateEventTransferExceptionAccountNotFound()
    {
        $eventExample = $this->createEventExample(EventTypesEnum::TRANSFER, 10, 1, 2);
        $mockEventRepository = Mockery::mock(EventTransferStrategy::class)
            ->shouldReceive('create')
            ->andReturn($eventExample);
        $this->app->instance(EventTransferStrategy::class, $mockEventRepository);

        $service = $this->app->make(EventService::class);
        $this->expectException(AccountNotFoundException::class);
        $service->createEvent($eventExample);
    }

    private function createAccountExample(int $id, ?float $balanceInicial = null): AccountEntity
    {
        $faker = Factory::create();
        $accountExample = new AccountEntity();
        $accountExample->setId($id);
        $accountExample->setBalance($balanceInicial ?: $faker->randomNumber(2));
        return $accountExample;
    }

    private function createEventExample(string $type, float $amount, ?int $origin, ?int $destination): EventEntity
    {
        $faker = Factory::create();
        $eventExample = new EventEntity();
        $eventExample->setId($faker->randomNumber());
        $eventExample->setType($type);
        $eventExample->setAccountIdOrigin($origin);
        $eventExample->setAccountIdDestination($destination);
        $eventExample->setAmount($amount);
        $eventExample->setStatus(EventStatusEnum::STARTED);
        return $eventExample;
    }
}
