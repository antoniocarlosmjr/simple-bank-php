<?php

namespace App\Application\Repositories;

interface ResetRepositoryInterface
{
    public function clearRecordsInTables(): void;
}
