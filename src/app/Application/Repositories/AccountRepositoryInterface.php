<?php

namespace App\Application\Repositories;

use App\Domain\Entities\Account\AccountEntity;

interface AccountRepositoryInterface
{
    public function create(AccountEntity $entity): AccountEntity;
    public function getAccountById(AccountEntity $entity): ?AccountEntity;
    public function update(AccountEntity $entity): AccountEntity;
}
