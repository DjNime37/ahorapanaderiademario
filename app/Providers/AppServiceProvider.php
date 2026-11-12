<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Repositories\ProductoRepositoryInterface;
use App\Repositories\ProductoRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            ProductoRepositoryInterface::class,
            ProductoRepository::class
        );
    }

    public function boot(): void
    {
        //
    }
}
