<?php

namespace App\Http\Controllers;

use App\Application\Services\AccountService;
use App\Domain\Entities\Account\AccountEntity;
use App\Http\Controllers\Contracts\AccountControllerInterface;
use App\Http\Requests\AccountRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class AccountController extends Controller implements AccountControllerInterface
{
    /**
     * @param AccountService $accountService
     */
    public function __construct(private AccountService $accountService){
    }

    /**
     * Return balance of the account
     *
     * @param AccountRequest $request
     * @return JsonResponse
     */
    public function getBalance(AccountRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $entity = new AccountEntity();
            $entity->setId((int)$data['account_id']);
            $response = $this->accountService->getBalanceByAccount($entity);
            return response()->json($response, Response::HTTP_OK);
        } catch (Throwable $e) {
            return response()->json(0, $e->getCode());
        }
    }
}
