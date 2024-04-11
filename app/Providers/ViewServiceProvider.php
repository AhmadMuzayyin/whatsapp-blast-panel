<?php

namespace App\Providers;

use App\Models\WhatsappAccount;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('navbar', function ($view) {
            $devices = WhatsappAccount::get();
            $view->with('devices', $devices);
        });
    }
}
