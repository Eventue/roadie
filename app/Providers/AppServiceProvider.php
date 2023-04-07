<?php

namespace App\Providers;

use App\Domain\Event\EventRepository;
use App\Domain\Profile\ProfileRepository;
use App\Domain\User\UserRepository;
use App\Infra\Eloquent\Repositories\EventRepositoryImpl;
use App\Infra\Eloquent\Repositories\ProfileRepositoryImpl;
use App\Infra\Eloquent\Repositories\UserRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepository::class,
            UserRepositoryImpl::class
        );

        $this->app->bind(
            ProfileRepository::class,
            ProfileRepositoryImpl::class
        );

        $this->app->bind(
            EventRepository::class,
            EventRepositoryImpl::class
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
