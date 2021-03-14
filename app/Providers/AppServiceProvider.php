<?php

namespace App\Providers;
use Laravel\Passport\Passport;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //$this->registerPolicies();
        Passport::routes();
        // Passport::tokensCan([
        //     'do-anything' => 'Perform any actions'
        // ]);
    }
}
