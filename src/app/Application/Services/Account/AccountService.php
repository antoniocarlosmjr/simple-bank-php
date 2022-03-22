<?php

namespace App\Application\Services\Account;

use App\Application\Repositories\AccountRepositoryInterface;
use App\Domain\Entities\Account\AccountEntity;
use App\Enumerators\AccountTypesEnum;
use App\Exceptions\AccountNotFoundException;
use App\Exceptions\BalanceUnavailableForWithdrawalException;

class AccountService
{
    public function __construct(
        protected AccountRepositoryInterface $accountRepository,
    ) {
    }

    public function getBalanceByAccount(AccountEntity $accountEntity): float
    {
        $account = $this->accountRepository->getAccountById($accountEntity);
        if ($account) {
            return $account->getBalance();
        }

        throw new AccountNotFoundException();
    }

    public function createInicialAccount(AccountEntity $entity): AccountEntity
    {
        $entity->setType(AccountTypesEnum::CHAIN);
        $entity->setActive(true);
        return $this->accountRepository->create($entity);
    }

    public function increaseMoney(AccountEntity $accountEntity, float $amount): AccountEntity
    {
        $newBalance = $accountEntity->getBalance() + $amount;
        $accountEntity->setBalance($newBalance);
        return $this->accountRepository->update($accountEntity);
    }

    public function decreaseMoney(AccountEntity $accountEntity, float $amount): AccountEntity
    {
        $balanceActual = $accountEntity->getBalance();

        if ($balanceActual >= $amount) {
            $newBalance = $accountEntity->getBalance() - $amount;
            $accountEntity->setBalance($newBalance);
            return $this->accountRepository->update($accountEntity);
        }

        throw new BalanceUnavailableForWithdrawalException();
    }
}
