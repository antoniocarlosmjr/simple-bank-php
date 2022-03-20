<?php

namespace App\Http\Controllers\Contracts;

use Illuminate\Http\Response;

interface ResetControllerInterface
{
    public function reset(): Response;
}
