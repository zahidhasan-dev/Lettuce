<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
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
        Paginator::useBootstrapFive();

        Blade::if('customer', function () {
           if(auth()->check()){
                if(! auth()->user()->is_admin){
                    return true;
                }
           }
        });

        View::composer('admin.authorization.*', function($view){
            $view->with([
                'roles' => \App\Models\Role::all(),
                'permissions' => \App\Models\Permission::all(),
            ]);
        });
        
    }


}
