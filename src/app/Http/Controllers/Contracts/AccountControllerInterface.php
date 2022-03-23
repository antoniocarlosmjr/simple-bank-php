<?php

namespace App\Http\Controllers\Contracts;

use App\Http\Requests\AccountRequest;
use Illuminate\Http\JsonResponse;

interface AccountControllerInterface
{
    /**
     * Get balance of a account.
     *
     * @OA\Get(
     *   path="/balance",
     *   description="Return a balance in a account of user",
     *   tags={"Balance"},
     *   security={
     *       {"Authorization": {}}
     *   },
     *   @OA\Parameter(
     *       name="account_id",
     *       in="query",
     *       description="Account id",
     *       required=true,
     *       @OA\Schema(
     *           type="integer"
     *       )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *           type="int",
     *           example=50
     *   )
     * ),
     *   @OA\Response(response=404, description="Not found"),
     *   @OA\Response(response=422, description="Invalid request body")
     * )
     */
    public function getBalance(AccountRequest $request): JsonResponse;
}
