<?php

namespace Tests\Unit\Services;

use App\Application\Repositories\AccountRepositoryInterface;
use App\Application\Services\Account\AccountService;
use App\Domain\Entities\Account\AccountEntity;
use App\Exceptions\AccountNotFoundException;
use App\Exceptions\BalanceUnavailableForWithdrawalException;
use Faker\Factory;
use Mockery;
use Tests\TestCase;

class AccountServiceTest extends TestCase
{
    public function testSuccessGetBalanceByAccount()
    {
        $accountExample = $this->createAccountExample();
        $mockAccountRepository = Mockery::mock(AccountRepositoryInterface::class)
            ->shouldReceive('getAccountById')
            ->andReturn($accountExample)
            ->getMock();
        $this->app->instance(AccountRepositoryInterface::class, $mockAccountRepository);

        $service = $this->app->make(AccountService::class);
        $result = $service->getBalanceByAccount($accountExample);

        $this->assertEquals($accountExample->getBalance(), $result);
    }

    public function testAccountNotFoundAccount()
    {
        $accountExample = $this->createAccountExample();
        $mockAccountRepository = Mockery::mock(AccountRepositoryInterface::class)
            ->shouldReceive('getAccountById')
            ->andReturn(null)
            ->getMock();
        $this->app->instance(AccountRepositoryInterface::class, $mockAccountRepository);

        $service = $this->app->make(AccountService::class);
        $this->expectException(AccountNotFoundException::class);
        $service->getBalanceByAccount($accountExample);
    }

    public function testCreateInicialAccount()
    {
        $accountExample = $this->createAccountExample();
        $mockAccountRepository = Mockery::mock(AccountRepositoryInterface::class)
            ->shouldReceive('create')
            ->andReturn($accountExample)
            ->getMock();
        $this->app->instance(AccountRepositoryInterface::class, $mockAccountRepository);

        $service = $this->app->make(AccountService::class);
        $result = $service->createInicialAccount($accountExample);

        $this->assertEquals($accountExample->toArray(), $result->toArray());
    }

    public function testIncreaseMoneyInAccount()
    {
        $accountExampleWithLessMoney = $this->createAccountExample(50);
        $accountExample = $this->createAccountExample(60);

        $mockAccountRepository = Mockery::mock(AccountRepositoryInterface::class)
            ->shouldReceive('update')
            ->andReturn($accountExample)
            ->getMock();
        $this->app->instance(AccountRepositoryInterface::class, $mockAccountRepository);

        $service = $this->app->make(AccountService::class);
        $result = $service->increaseMoney($accountExampleWithLessMoney, 10);

        $this->assertEquals(60, $result->getBalance());
    }

    public function testDecreaseMoneyInAccount()
    {
        $accountExampleWithMoreMoney = $this->createAccountExample(60);
        $accountExample = $this->createAccountExample(50);

        $mockAccountRepository = Mockery::mock(AccountRepositoryInterface::class)
            ->shouldReceive('update')
            ->andReturn($accountExample)
            ->getMock();
        $this->app->instance(AccountRepositoryInterface::class, $mockAccountRepository);

        $service = $this->app->make(AccountService::class);
        $result = $service->increaseMoney($accountExampleWithMoreMoney, 10);

        $this->assertEquals(50, $result->getBalance());
    }

    public function testDecreaseMoneyAndBalanceUnavailableAccount()
    {
        $accountExample = $this->createAccountExample();
        $valueToDecrease = $accountExample->getBalance() + 10;

        $mockAccountRepository = Mockery::mock(AccountRepositoryInterface::class)
            ->shouldReceive('getAccountById')
            ->andReturn(null)
            ->getMock();
        $this->app->instance(AccountRepositoryInterface::class, $mockAccountRepository);

        $service = $this->app->make(AccountService::class);
        $this->expectException(BalanceUnavailableForWithdrawalException::class);
        $service->decreaseMoney($accountExample, $valueToDecrease);
    }


    private function createAccountExample(?float $balanceInicial = null): AccountEntity
    {
        $faker = Factory::create();
        $accountExample = new AccountEntity();
        $accountExample->setId($faker->randomNumber());
        $accountExample->setBalance($balanceInicial ?: $faker->randomNumber(2));
        return $accountExample;
    }
}
