<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResetController extends Controller
{
    public function reset(): Response
    {
        // TODO - reset database
        return new Response('OK', JsonResponse::HTTP_OK);
    }
}
