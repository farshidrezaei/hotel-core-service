<?php

namespace App\Providers;

use App\Contracts\RoomRepositoryContract;
use App\Repositories\RoomRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RoomRepositoryContract::class,RoomRepository::class);
    }


}
