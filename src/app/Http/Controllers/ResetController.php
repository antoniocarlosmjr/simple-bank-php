<?php

namespace App\Http\Controllers;

use App\Application\Services\Reset\ResetService;
use App\Http\Controllers\Contracts\ResetControllerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class ResetController extends Controller implements ResetControllerInterface
{
    public function __construct(private ResetService $resetService)
    {
    }

    /**
     * Reset database and all records in database.
     *
     * @return Response
     */
    public function reset(): Response
    {
        try {
            $this->resetService->reset();
            return Response('OK', Response::HTTP_OK);
        } catch (Exception $e) {
            return Response($e->getMessage(), $e->getCode() ?: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
