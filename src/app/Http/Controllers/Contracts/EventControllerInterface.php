<?php

namespace App\Http\Controllers\Contracts;

use App\Http\Requests\CreateEventRequest;
use Illuminate\Http\JsonResponse;

interface EventControllerInterface
{
    /**
     * Make a transation of deposit, withdraw or transfer.
     * For deposit, we can create a new account with inicial balance.
     *
     * @OA\Post(
     *   path="/event",
     *   description="Make a event in bank",
     *   tags={"Event"},
     *   security={
     *       {"Authorization": {}}
     *   },
     *   @OA\RequestBody(
     *     request="CreateEventRequest",
     *     description="Create event request",
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/json",
     *       @OA\Schema(ref="#/components/schemas/CreateEventRequest")
     *   ),
     *  ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *           type="object",
     *           @OA\Property(property="destination", type="array",
     *              @OA\Items(
     *                   @OA\Property(property="id", type="string", description="Account id"),
     *                   @OA\Property(property="balance", type="integer", description="balance in account"),
     *           )
     *      )
     *   )
     * ),
     *   @OA\Response(response=404, description="Not found"),
     *   @OA\Response(response=422, description="Invalid request body")
     * )
     */
    public function create(CreateEventRequest $request): JsonResponse;
}
