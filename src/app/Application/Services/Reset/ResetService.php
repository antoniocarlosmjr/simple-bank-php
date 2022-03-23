<?php

namespace App\Application\Services\Reset;

use App\Driver\Models\AccountModel;
use App\Driver\Models\EventModel;

class ResetService
{
    /**
     * Clear database and reset status before tests and begin API.
     *
     * @return void
     */
    public function reset()
    {
        AccountModel::truncate();
        EventModel::truncate();
    }
}
