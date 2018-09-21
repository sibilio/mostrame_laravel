<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('email_confirmation', function($atribute, $value, $parameters, $validator){
           if($parameters[0] == $value)
              return true;
           else
              return false;
        });
        
        Validator::extend('password_confirmation', function($atribute, $value, $parameters, $validator){
           if($parameters[0] == $value)
              return true;
           else
              return false;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
