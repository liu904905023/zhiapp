<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TempleteServiceProvide extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::if ('member', function () {
            return auth()->check();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
