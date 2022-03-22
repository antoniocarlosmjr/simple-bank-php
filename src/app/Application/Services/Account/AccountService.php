<?php

namespace App\Application\Services\Account;

use App\Application\Repositories\AccountRepositoryInterface;
use App\Domain\Entities\Account\AccountEntity;

class AccountService
{
    public function __construct(
        protected AccountRepositoryInterface $accountRepository,
    ) {
    }

    public function getBalanceByAccount(AccountEntity $accountEntity): float
    {
        $account = $this->accountRepository->getAccountById($accountEntity);
        return $account->getBalance();
    }

    public function increaseMoney()
    {

    }

    public function decreaseMoney()
    {

    }
}