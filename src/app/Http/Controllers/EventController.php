<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Contracts\EventControllerInterface;
use App\Http\Requests\CreateEventRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EventController implements EventControllerInterface
{
    /**
     * Create a event in a bank with any account
     *
     * @param CreateEventRequest $request
     * @return JsonResponse
     */
    public function create(CreateEventRequest $request): JsonResponse
    {
        // TODO: Implement create() method.
        $response = [];
        return response()->json($response, Response::HTTP_OK);
    }
}
