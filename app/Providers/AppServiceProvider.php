<?php

namespace App\Providers;

use App\Contracts\ExpenseRepositoryContract;
use App\Repositories\ExpenseRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(ExpenseRepositoryContract::class, ExpenseRepository::class);

    }
}
