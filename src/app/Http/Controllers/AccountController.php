<?php

namespace App\Http\Controllers;

use App\Application\Services\AccountService;
use App\Http\Controllers\Contracts\AccountControllerInterface;
use App\Http\Requests\AccountRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller implements AccountControllerInterface
{
    private AccountService $accountService;

    /**
     * @param AccountService $accountService
     */
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    /**
     * Return balance of the account
     *
     * @param AccountRequest $request
     * @return JsonResponse
     */
    public function getBalance(AccountRequest $request): JsonResponse
    {
        $data = $request->validated();
        $balance = $this->accountService->getBalanceOfAccount($data['account_id']);
        return response()->json($balance, Response::HTTP_OK);
    }
}
