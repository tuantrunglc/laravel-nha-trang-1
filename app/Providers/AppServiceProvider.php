<?php

namespace App\Providers;

use App\Models\Notification;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\View;
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
        User::observe(UserObserver::class);
        View::composer('*', function ($view) {
            $view->with('notifications', Notification::where('read', false)->get());
        });
        view()->composer('adminlte::page', \App\Http\ViewComposers\NotificationComposer::class);
    }
}
