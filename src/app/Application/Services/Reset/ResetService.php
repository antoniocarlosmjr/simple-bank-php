<?php

namespace App\Application\Services\Reset;

use App\Application\Repositories\ResetRepositoryInterface;

class ResetService
{
    public function __construct(
        protected ResetRepositoryInterface $resetRepository
    ) {
    }

    /**
     * Clear database and reset status before tests and begin API.
     *
     * @return void
     */
    public function reset(): void
    {
        $this->resetRepository->clearRecordsInTables();
    }
}
