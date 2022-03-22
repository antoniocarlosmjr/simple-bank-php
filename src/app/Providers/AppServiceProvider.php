<?php

namespace App\Providers;

use App\Application\Repositories\AccountRepositoryInterface;
use App\Application\Repositories\EventRepositoryInterface;
use App\Infra\Repositories\AccountRepositoryDatabase;
use App\Infra\Repositories\EventRepositoryDatabase;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            AccountRepositoryInterface::class,
            AccountRepositoryDatabase::class
        );

        $this->app->bind(
            EventRepositoryInterface::class,
            EventRepositoryDatabase::class
        );
    }
}
