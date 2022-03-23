<?php

namespace App\Providers;

use App\Application\Repositories\AccountRepositoryInterface;
use App\Application\Repositories\EventRepositoryInterface;
use App\Application\Repositories\ResetRepositoryInterface;
use App\Infra\Repositories\AccountRepositoryDatabase;
use App\Infra\Repositories\EventRepositoryDatabase;
use App\Infra\Repositories\ResetRepositoryDatabase;
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

        $this->app->bind(
            ResetRepositoryInterface::class,
            ResetRepositoryDatabase::class
        );
    }
}
