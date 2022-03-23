<?php

namespace App\Infra\Repositories;

use App\Application\Repositories\ResetRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ResetRepositoryDatabase implements ResetRepositoryInterface
{
    /**
     * Reset all records in database.
     *
     * @return void
     */
    public function clearRecordsInTables(): void
    {
        $tables = DB::select('SHOW TABLES');
        foreach($tables as $table){
            if ($table == 'migrations') {
                continue;
            }
            DB::table($table->Tables_in_simple_bank_php)->truncate();
        }
    }
}
