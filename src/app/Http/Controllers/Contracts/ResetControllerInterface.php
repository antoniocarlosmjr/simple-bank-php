<?php

namespace App\Http\Controllers\Contracts;

use Symfony\Component\HttpFoundation\Response;

interface ResetControllerInterface
{
    /**
     * Reset state before starting tests.
     *
     * @OA\Post(
     *   path="/reset",
     *   description="Reset state before starting tests",
     *   tags={"Reset"},
     *   security={
     *       {"Authorization": {}}
     *   },
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *           type="string",
     *           example="OK"
     *   )
     * ),
     *   @OA\Response(response=404, description="Not found"),
     *   @OA\Response(response=422, description="Invalid request body")
     * )
     */
    public function reset(): Response;
}
