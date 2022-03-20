<?php

namespace App\Application\Repositories;

use App\Domain\Entities\Account\AccountEntity;

interface AccountRepositoryInterface
{
    public function create(AccountEntity $accountEntity): AccountEntity;
    public function getAccountById(AccountEntity $accountEntity): AccountEntity;
}
