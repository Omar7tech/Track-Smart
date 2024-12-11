<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('admin', function (User $user): bool {
            return $user->role === 'admin';
        });

        Gate::define('analyst', function (User $user) {
            return $user->role === 'analyst';
        });

        Gate::define('employee', function (User $user) {
            return $user->role === 'employee';
        });
    }
}
