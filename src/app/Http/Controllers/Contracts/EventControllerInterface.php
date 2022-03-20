<?php

namespace App\Http\Controllers\Contracts;

use App\Http\Requests\CreateEventRequest;
use Illuminate\Http\JsonResponse;

interface EventControllerInterface
{
    public function create(CreateEventRequest $request): JsonResponse;
}
