<?php

namespace App\Application\Services;

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
}
