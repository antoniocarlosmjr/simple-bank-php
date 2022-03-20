<?php

namespace App\Infra\Repositories;

use App\Application\Repositories\AccountRepositoryInterface;
use App\Domain\Entities\Account\AccountEntity;
use App\Driver\Models\AccountModel;
use App\Exceptions\AccountNotFoundException;
use Exception;

class AccountRepositoryDatabase implements AccountRepositoryInterface
{
    public function __construct(
        private AccountModel $accountModelEloquent
    ) {
    }

    public function create(AccountEntity $accountEntity): AccountEntity
    {
        // TODO: Implement createAccount() method.
        return $accountEntity;
    }

    /**
     * Return entity account by id.
     *
     * @param AccountEntity $entity
     * @return AccountEntity
     * @throws AccountNotFoundException|Exception
     */
    public function getAccountById(AccountEntity $entity): AccountEntity
    {
        $register = $this->accountModelEloquent::where(['id' => $entity->getId()])->first();
        if (!$register) {
            throw new AccountNotFoundException();
        }
        return $entity->fill($register->toArray());
    }
}
