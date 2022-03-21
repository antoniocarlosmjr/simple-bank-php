<?php

namespace App\Http\Controllers;

use App\Application\Services\EventService;
use App\Domain\Entities\Event\EventEntity;
use App\Enumerators\EventStatusEnum;
use App\Http\Controllers\Contracts\EventControllerInterface;
use App\Http\Requests\CreateEventRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EventController implements EventControllerInterface
{
    public function __construct(private EventService $eventService){
    }

    /**
     * Create a event in a bank with any account
     *
     * @param CreateEventRequest $request
     * @return JsonResponse
     */
    public function create(CreateEventRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $entityEvent = new EventEntity();
            $entityEvent->setType($data['type']);
            $entityEvent->setOrigin((int)$data['origin']);
            $entityEvent->setDestination((int)$data['destination']);
            $entityEvent->setAmount((float)$data['amount']);
            $entityEvent->setStatus(EventStatusEnum::STARTED);

            $response = $this->eventService->createEvent($entityEvent);
            return response()->json($response, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
