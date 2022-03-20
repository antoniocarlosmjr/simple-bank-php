<?php

namespace App\Infra\Repositories;

use App\Application\Repositories\AccountRepositoryInterface;
use App\Domain\Entities\Account\AccountEntity;
use App\Driver\Models\AccountModel;
use App\Exceptions\AccountNotFoundException;
use Exception;
use Illuminate\Support\Collection;

class AccountRepositoryDatabase implements AccountRepositoryInterface
{
    public function __construct(
        private AccountModel $accountModelEloquent
    ) {
    }

    /**
     * Create a new account
     *
     * @param AccountEntity $entity
     * @return AccountEntity
     */
    public function create(AccountEntity $entity): AccountEntity
    {
        $modelRegister = $this->accountModelEloquent::create($entity->toArray());
        $register = $this->transformPayload(
            collect([$modelRegister])
        )->collapse()->all();
        return $entity->fill($register);
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

    /**
     * Transform payload return
     *
     * @param Collection $collect
     * @return Collection
     */
    private function transformPayload(Collection $collect): Collection
    {
        return $collect->transform(function ($item) {
            return [
                'id' => $item->id,
                'balance' => $item->balance,
            ];
        });
    }
}
