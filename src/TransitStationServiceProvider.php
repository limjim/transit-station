<?php

namespace Megaads\TransitStation;

use Illuminate\Support\ServiceProvider;

class TransitStationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/routes.php';
    }

    public function register() {
        
    }
}
