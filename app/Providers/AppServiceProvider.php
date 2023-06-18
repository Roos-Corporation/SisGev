<?php

namespace App\Providers;

use App\Repositories\CoffeeSpaceEloquentORM;
use App\Repositories\CoffeeSpaceRepositoryInterface;
use App\Repositories\EventRoomEloquentORM;
use App\Repositories\EventRoomRepositoryInterface;
use App\Repositories\PersonEloquentORM;
use App\Repositories\PersonRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Person
        $this->app->bind(
            PersonRepositoryInterface::class,
            PersonEloquentORM::class
        );

        //EventRoom
        $this->app->bind(
            EventRoomRepositoryInterface::class,
            EventRoomEloquentORM::class
        );

        //CoffeeSpace
        $this->app->bind(
            CoffeeSpaceRepositoryInterface::class,
            CoffeeSpaceEloquentORM::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
