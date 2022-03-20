<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Contracts\ResetControllerInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResetController extends Controller implements ResetControllerInterface
{
    public function reset(): Response
    {
        // TODO - reset database
        return new Response('OK', JsonResponse::HTTP_OK);
    }
}
