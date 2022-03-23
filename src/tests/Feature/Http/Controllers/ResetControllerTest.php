<?php

namespace Tests\Feature\Http\Controllers;

use App\Application\Repositories\ResetRepositoryInterface;
use App\Application\Services\Event\EventDepositStrategy;
use Illuminate\Http\Response;
use Mockery;
use Tests\FunctionalTestCase;

class ResetControllerTest extends FunctionalTestCase
{
    public function testShouldReturnSucessCreateEvent()
    {
        $mockResetRepository = Mockery::mock(ResetRepositoryInterface::class)->makePartial();
        $mockResetRepository
            ->shouldReceive('clearRecordsInTables');
        $this->app->instance(EventDepositStrategy::class, $mockResetRepository);

        $this->post('/reset', []);
        $this->assertResponseStatus(Response::HTTP_OK);
    }
}
