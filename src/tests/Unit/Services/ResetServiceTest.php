<?php

namespace Tests\Unit\Services;

use App\Application\Repositories\ResetRepositoryInterface;
use App\Application\Services\Reset\ResetService;
use Mockery;
use Tests\TestCase;

class ResetServiceTest extends TestCase
{
    public function testSuccessResetDatabase()
    {
        $mockAccountRepository = Mockery::mock(ResetRepositoryInterface::class)
            ->shouldReceive('clearRecordsInTables')
            ->getMock();
        $this->app->instance(ResetRepositoryInterface::class, $mockAccountRepository);

        $service = $this->app->make(ResetService::class);
        $result = $service->reset();

        $this->assertEquals(true, $result);
    }
}
