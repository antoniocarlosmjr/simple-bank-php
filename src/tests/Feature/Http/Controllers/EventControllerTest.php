<?php

namespace Tests\Feature\Http\Controllers;

use App\Application\Repositories\AccountRepositoryInterface;
use App\Application\Services\Event\EventDepositStrategy;
use App\Application\Services\Event\EventWithdrawStrategy;
use App\Domain\Entities\Account\AccountEntity;
use App\Exceptions\AccountNotFoundException;
use Faker\Factory;
use Illuminate\Http\Response;
use Mockery;
use Tests\FunctionalTestCase;

class EventControllerTest extends FunctionalTestCase
{
    public function testShouldReturnSucessCreateEvent()
    {
        $data = [
            'type' => 'deposit',
            'destination' => '10',
            'amount' => 15
        ];
        $accountExample = $this->createAccountExample(10, 10);

        $mockEventContext = Mockery::mock(EventDepositStrategy::class)->makePartial();
        $mockEventContext
            ->shouldReceive('create')
            ->andReturn($accountExample);
        $this->app->instance(EventDepositStrategy::class, $mockEventContext);

        $this->post('/event', $data);
        $this->assertResponseStatus(Response::HTTP_CREATED);
    }

    public function testShouldReturn404CreateEvent()
    {
        $data = [
            'type' => 'withdraw',
            'origin' => '100',
            'amount' => 15
        ];

        $mockEventContext = Mockery::mock(EventWithdrawStrategy::class)->makePartial();
        $mockEventContext
            ->shouldReceive('create')
            ->andThrow(new AccountNotFoundException());
        $this->app->instance(EventWithdrawStrategy::class, $mockEventContext);

        $this->post('/event', $data);
        $this->assertResponseStatus(Response::HTTP_NOT_FOUND);
    }

    private function createAccountExample(int $id, ?float $balanceInicial = null): AccountEntity
    {
        $faker = Factory::create();
        $accountExample = new AccountEntity();
        $accountExample->setId($id);
        $accountExample->setBalance($balanceInicial ?: $faker->randomNumber(2));
        return $accountExample;
    }
}
