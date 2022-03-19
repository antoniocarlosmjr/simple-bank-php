<?php

namespace App\Http\Controllers\Contracts;

use App\Http\Requests\AccountRequest;
use Illuminate\Http\JsonResponse;

interface AccountControllerInterface
{
    public function getBalance(AccountRequest $request): JsonResponse;
}
