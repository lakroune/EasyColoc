<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('view_admin_panel', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('invite_member', function ($user, $colocation) {
            return $user->id === $colocation->owner_id;
        });
    }
}
