<?php

namespace Tests\Feature\Http\Controllers;

use App\Application\Repositories\AccountRepositoryInterface;
use App\Domain\Entities\Account\AccountEntity;
use App\Enumerators\AccountTypesEnum;
use Illuminate\Http\Response;
use Mockery;
use Tests\FunctionalTestCase;

class AccountControllerTest extends FunctionalTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testShouldReturnSuccessInBalanceOfAccount(): void
    {
        $accountExample = $this->getExampleAccount();
        $mockAccountRepository = Mockery::mock(AccountRepositoryInterface::class)->makePartial();
        $mockAccountRepository
            ->shouldReceive('getAccountById')
            ->andReturn($accountExample);
        $this->app->instance(AccountRepositoryInterface::class, $mockAccountRepository);

        $this->get(
            '/balance',
            [],
            ['account_id' => $accountExample->getId()]
        )->assertResponseOk();
    }

    public function testShouldReturn404InBalanceOfAccount(): void
    {
        $accountExample = $this->getExampleAccount();
        $this->get(
            '/balance',
            [],
            ['account_id' => $accountExample->getId()]
        )->assertResponseStatus(Response::HTTP_NOT_FOUND);
    }

    private function getExampleAccount(): AccountEntity
    {
        $accountEntity = new AccountEntity();
        $accountEntity->setId(1);
        $accountEntity->setType(AccountTypesEnum::CHAIN);
        $accountEntity->setBalance(10);
        $accountEntity->setActive(true);
        return $accountEntity;
    }
}
