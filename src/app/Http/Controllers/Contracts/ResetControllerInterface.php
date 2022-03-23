<?php

namespace App\Http\Controllers\Contracts;

use Symfony\Component\HttpFoundation\Response;

interface ResetControllerInterface
{
    public function reset(): Response;
}
