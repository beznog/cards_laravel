<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class APIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Helpers/APIHelpers/LingvoAPI.php';
        require_once app_path() . '/Helpers/APIHelpers/GoogleSearchAPI.php';
        require_once app_path() . '/Helpers/_Arr.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
