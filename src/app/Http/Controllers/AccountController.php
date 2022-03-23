<?php

namespace App\Http\Controllers;

use App\Application\Services\Account\AccountService;
use App\Domain\Entities\Account\AccountEntity;
use App\Http\Controllers\Contracts\AccountControllerInterface;
use App\Http\Requests\AccountRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
        } catch (Exception $e) {
            return response()->json($e->getMessage(), $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
