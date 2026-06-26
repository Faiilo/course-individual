<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;  // <-- ЭТА СТРОЧКА НОВАЯ!
use App\Models\User;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ПРИНУДИТЕЛЬНО ИСПОЛЬЗУЕМ HTTPS НА ПРОДАКШЕНЕ
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        Gate::define('admin', function (User $user) {
            return $user->isAdmin();
        });

        Paginator::defaultView('pagination.default');
    }
}